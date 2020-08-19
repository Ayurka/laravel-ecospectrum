<div id="app-filter">
    <button type="button" class="btn btn-primary btn-out-dashed" @click="addNewFilter"><i class="icofont icofont-plus"></i> Добавить</button>
    <div class="m-t-20">
        <div v-for="(item, index) in filterList" :key="index">
            <div class="filter-list">
                <h5>@{{ item.groupName.name }}</h5>
                <div v-if="item.groupName.id">
                    <input type="hidden" :name="'groupList[' + index + '][groupOld][id]'" :value="item.groupName.id">
                    <input type="hidden" :name="'groupList[' + index + '][groupOld][name]'" :value="item.groupName.name">
                </div>
                <div v-else>
                    <input type="hidden" :name="'groupList[' + index + '][groupNew]'" :value="item.groupName.name">
                </div>
                <div style="display: inline-block">
                    <a href="#" style="padding: 14px 0;" @click="edit(index)">редактировать</a>
                    <a href="#" style="padding: 14px 20px;" @click="deleteGroup(index)">удалить</a>
                </div>
            </div>
            <div class="filter-items">
                <ul class="basic-list">
                    <li v-for="(param, idx) in item.params" :key="idx" class="">
                        <h6>@{{ param.name }}</h6>
                        <div v-if="param.id">
                            <input type="hidden" :name="'groupList[' + index + '][paramsOld][' + idx + '][id]'" :value="param.id">
                            <input type="hidden" :name="'groupList[' + index + '][paramsOld][' + idx + '][name]'" :value="param.name">
                        </div>
                        <div v-else>
                            <input type="hidden" :name="'groupList[' + index + '][paramsNew][]'" :value="param.name">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление фильтра</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Название группы</label>
                        <div class="col-sm-9">
                            <input type="text" v-model="inputGroupName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Название фильтра</label>
                        <div class="col-sm-8">
                            <input type="text" v-model="inputName" class="form-control">
                        </div>
                        <div class="col-sm-1">
                            <button @click="addToFilters" type="button" class="btn btn-primary btn-icon" style="width: 35px; height: 35px; line-height: 25px">
                                <i class="icofont icofont-plus" style="margin: 0"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Список фильтров:</label>
                        <div class="col-sm-9">
                            <div class="form-group row" v-for="(filter, index) in filters" :key="index">
                                <div class="col">
                                    <input type="text" v-model="filter.name" class="form-control">
                                </div>
                                <div class="col">
                                    <button @click="deleteFilter(index)" type="button" class="btn btn-danger btn-icon" style="width: 35px; height: 35px; line-height: 25px">
                                        <i class="icofont icofont-close" style="margin: 0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">закрыть</button>
                    <button @click="saveFilter" type="button" class="btn btn-primary waves-effect waves-light">сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    new Vue({
        el: '#app-filter',
        data: () => ({
            inputGroupName: null,
            inputName: null,
            filters: [],
            filterList: [],
            current: null
        }),
        mounted () {
            this.filterList = {!! isset($filters) ? $filters : json_encode([]) !!};
        },
        methods: {
            addNewFilter () {
                this.inputGroupName = null;
                this.inputName = null;
                this.filters = [];
                this.current = null;
                $('#large-Modal').modal('show');
            },
            addToFilters () {
                if (!this.inputName) {
                    return;
                }
                this.filters.push({ type: 'new', name: this.inputName });
                this.inputName = null;
            },
            async deleteFilter (index) {
                const id = this.filters[index].id;
                if (id) {
                    try {
                        await axios.delete(`http://localhost/admin/filterDelete/${id}`);
                    } catch (e) {
                        throw e;
                    }
                }
                this.filters.splice(index, 1);
            },
            saveFilter () {
                if (!this.inputGroupName) {
                    return;
                }
                if (this.current === null) {
                    this.filterList.push({
                        groupName: { type: 'new', name: this.inputGroupName, },
                        params: this.filters
                    });
                } else {
                    const currentFilter = this.filterList.filter((item, index) => index === this.current)[0];
                    currentFilter.groupName.name = this.inputGroupName;
                    currentFilter.params = this.filters;
                    this.filterList[this.current] = {
                        groupName: currentFilter.groupName,
                        params: currentFilter.params
                    }
                }
                this.inputGroupName = null;
                this.inputName = null;
                this.filters = [];
                this.current = null;
                $('#large-Modal').modal('hide');
            },
            edit (index) {
                this.current = index;
                const groupFilter = this.filterList.filter((item, i) => i === index)[0];
                this.inputGroupName = groupFilter.groupName.name;
                this.filters = groupFilter.params;
                $('#large-Modal').modal('show');
            },
            async deleteGroup (index) {
                const id = this.filterList[index].groupName.id;
                if (id) {
                    try {
                        await axios.delete(`http://localhost/admin/filterGroupDelete/${id}`);
                    } catch (e) {
                        throw e;
                    }
                }
                this.filterList.splice(index, 1);
            }
        }
    })
</script>
@endpush

@push('after-styles')
    <style>
        .filter-list {
            display: flex;
            justify-content: space-between;
        }
        .filter-items {
            padding-left: 30px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .basic-list li {
            margin-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }
        .basic-list li h6{
            margin: 0;
        }
    </style>
@endpush
