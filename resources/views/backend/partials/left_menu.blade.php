<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Навигация</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Рабочий стол</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather feather icon-edit"></i></span>
                    <span class="pcoded-mtext">Страницы</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ route('admin.page.index') }}">
                            <span class="pcoded-mtext">Записи</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.page_category.index') }}">
                            <span class="pcoded-mtext">Категории</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                    <span class="pcoded-mtext">Каталог</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ route('admin.product.index') }}">
                            <span class="pcoded-mtext">Товары</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.category.index') }}">
                            <span class="pcoded-mtext">Категории</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.attribute.index') }}">
                            <span class="pcoded-mtext">Характеристики</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.filter.index') }}">
                            <span class="pcoded-mtext">Фильтры</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('admin.order.index') }}">
                    <span class="pcoded-micon"><i class="icofont icofont-order"></i></span>
                    <span class="pcoded-mtext">Заказы</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.user.index') }}">
                    <span class="pcoded-micon"><i class="icofont icofont-user"></i></span>
                    <span class="pcoded-mtext">Пользователи</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.news.index') }}">
                    <span class="pcoded-micon"><i class="icofont icofont-newspaper"></i></span>
                    <span class="pcoded-mtext">Новости</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.menu.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Меню</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.file_manager') }}">
                    <span class="pcoded-micon"><i class="feather icon-file-plus"></i></span>
                    <span class="pcoded-mtext">Файловый менеджер</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.logs') }}">
                    <span class="pcoded-micon"><i class="feather icon-alert-triangle"></i></span>
                    <span class="pcoded-mtext">Журнал ошибок</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
