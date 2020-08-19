@extends('backend.layouts.app')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Breadcrumb Styles</h4>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Basic Components</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Breadcrumb</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="app" style="width: 100%">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Добавить фильтр</label>
                    <div class="col-sm-8">
                        <input type="text" v-model="filterItem" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <button @click="addToFilterList" class="btn btn-success">Добавить</button>
                    </div>
                </div>
                <ul class="basic-list">
                    <li
                        v-for="(item, index) in filterList"
                        :key="index"
                    ><p>@{{ item }}<button class="btn btn-danger btn-mini">Удалить</button></p></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        new Vue({
            el: '#app',
            data: () => ({
                filterItem: '',
                filterList: []
            }),
            methods: {
                addToFilterList () {
                    if (!this.filterItem) {
                        return;
                    }
                    this.filterList.push(this.filterItem);
                    this.filterItem = '';
                }
            }
        })
    </script>
@endpush
