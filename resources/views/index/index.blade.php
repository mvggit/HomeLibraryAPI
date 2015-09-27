@extends('app')

@section('title', 'Индекс')

@section('content')
<div ng-class="{ 'frozen':$root._frozen }"></div>
<div class="container" ng-controller="main" ng-if="$root.page.main">
    <div class="row">
        <div class="col-md-4 col-md-offset-1 pull-right voffset">
            <ul class="nav pull-left">
                <li>
                    <input type="button" go-to-page page="main" class="btn btn-default" value="{{trans('app.enter')}}">
                </li>
                <li>
                    <input type="button" go-to-page page="edit" class="btn btn-default" value="{{trans('app.new')}}">
                </li>
            </ul>
        </div>
        <div class="col-md-6 col-md-offset-1 voffset">
        <tabset>
            <tab>
                <tab-heading class="cursor-pointer">
                    {{trans('app.tab.search.caption')}}
                </tab-heading>
                <label for="search_by_name">{{trans('app.search')}}</label>
                <input type="text" ng-model="search.name" class="search_by" id="search_by_name">
                <button ng-click="find(search.name, 'name')" class="btn btn-primary">{{trans('app.btn.search')}}</button>
            </tab>
            <tab>
                <tab-heading class="cursor-pointer">
                    {{trans('app.tab.search.author')}}
                </tab-heading>
                <label for="search_by_author">{{trans('app.search')}}</label>
                <input type="text" ng-model="search.author" class="search_by" id="search_by_author">
                <button ng-click="find(search.author, 'author')" class="btn btn-primary">{{trans('app.btn.search')}}</button>
            </tab>
            <tab>
                <tab-heading class="cursor-pointer">
                    {{trans('app.tab.search.ISDN')}}
                </tab-heading>
                <label for="search_by_ISDN">{{trans('app.search')}}</label>
                <input type="text" ng-model="search.ISDN" class="search_by" id="search_by_ISDN">
                <button ng-click="find(search.ISDN, 'ISBN')" class="btn btn-primary">{{trans('app.btn.search')}}</button>
            </tab>
        </tabset>
        </div>
        <div class="col-md-11 col-md-offset-1 voffset">
            <h1>{{trans('app.catalog')}}</h1>
        </div>
        <div class="col-md-10 col-md-offset-1 voffset">
            <ul class="sort">
                <li class="sort">
                    <span>Сортировать по:</span>
                </li>
                <li class="sort">
                    <span ng-click="sort('name')" class="link">название</span>
                </li>
                <li class="sort">
                    <span ng-click="sort('author')" class="link">автор</span>
                </li>
                <li class="sort">
                    <span ng-click="sort('ISBN')" class="link">ISBN</span>
                </li>
            </ul>
        </div>
        <div ng-repeat="book in list" class="col-md-3 col-md-offset-1 voffset">
            <div class="col-md-10 voffset">
                <h5><b>@{{book.name}}</b></h5>
            </div>
            <div class="col-md-2 voffset">
                <input type="button" delete page="@{{currentPage}}" ids="@{{book.id}}" class="btn btn-danger btn-xs pull-left" value="X">
            </div>
            <div class="col-md-12 small">
                Автор @{{book.author}}
            </div>
            <div class="col-md-12 small">
                год издания @{{book.publication}}
            </div>
            <div class="col-md-12 small">
                ISBN @{{book.ISBN}}
            </div>
            <div class="col-md-11 col-md-offset-1 voffset">
                <input type="button" go-to-page page="book" items="_book" ids="@{{$index}}" class="btn btn-primary pull-left" value="Подробнее">
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <ul class="pagination">
                <li ng-repeat="page in pageLimit" class="pagination">
                    <button ng-click="paginated(page)" ng-disabled="currentPage == page" class="btn-xs pagination" ng-class="{'active' : currentPage == page}">@{{page}}</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container" ng-controller="book" ng-if="page.book">
    <div class="row">
        <div class="col-md-5 col-md-offset-2 pull-right voffset">
            <ul class="nav pull-left">
                <li>
                    <input type="button" go-to-page page="main" class="btn btn-default" value="{{trans('app.enter')}}">
                </li>
                <li>
                    <input type="button" go-to-page page="edit" class="btn btn-default" value="{{trans('app.new')}}">
                </li>
            </ul>
        </div>
        <div class="col-md-10 col-md-offset-1 voffset">
            <h1>@{{_book.name}}</h1>
        </div>
        <div class="col-md-10 col-md-offset-1 voffset">
            <div class="col-md-3 cover" ng-if="_book.cover">
                <img ng-src='images/cover/@{{_book.cover}}' alt="@{{_book.description}}">
            </div>
            <div class="col-md-7">
                <div class="col-md-10">
                    Автор @{{_book.author}}
                </div>
                <div class="col-md-10">
                    год издания @{{_book.publication}}
                </div>
                <div class="col-md-10">
                    ISBN @{{_book.ISBN}}
                </div>
                <div class="col-md-10 hr">
                    Описание @{{_book.description}}
                </div>
                <div class="col-md-10">
                    <input type="button" edit page="edit" class="btn btn-primary" value="Редактировать">
                    <input type="button" delete page="main" ids="@{{_book.id}}" class="btn btn-danger" value="Удалить">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" ng-controller="edit" ng-if="page.edit">
    <div class="row">
        <div class="col-md-5 col-md-offset-2 pull-right voffset">
            <ul class="nav pull-left">
                <li>
                    <input type="button" go-to-page page="main" class="btn btn-default" value="{{trans('app.enter')}}">
                </li>
                <li>
                    <input type="button" go-to-page page="edit" class="btn btn-default" value="{{trans('app.new')}}">
                </li>
            </ul>
        </div>
        <div class="col-md-10 col-md-offset-1 voffset">
            <h1>{{trans('app.edit')}}</h1>
        </div>
        <div class="col-md-10 col-md-offset-1 voffset">
            <form name="editbookform" enctype="multipart/form-data" novalidate>
                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>Название: *</span>
                    </div>
                    <div class="col-md-7" ng-class="{ 'has-error' : editbookform.name.$invalid && !editbookform.name.$pristine}">
                        <input type="text" ng-model="editbook.name" name="name" class="form-control" ng-maxlength="150" required="required">
                        <p class="form-error" ng-show="editbookform.name.$invalid && !editbookform.name.$pristine">
                            {{trans('app.add-form.error.name')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>Автор: *</span>
                    </div>
                    <div class="col-md-7" ng-class="{ 'has-error' : editbookform.author.$invalid && !editbookform.author.$pristine}">
                        <input type="text" ng-model="editbook.author" name="author" class="form-control"  ng-maxlength="100" required="required">
                        <p class="form-error" ng-show="editbookform.author.$invalid && !editbookform.author.$pristine">
                            {{trans('app.add-form.error.name')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>ISBN: *</span>
                    </div>
                    <div class="col-md-7" ng-class="{ 'has-error' : editbookform.ISBN.$invalid && !editbookform.ISBN.$pristine}">
                        <input type="text" ng-model="editbook.ISBN" name="ISBN" class="form-control"  ng-maxlength="50" required="required">
                        <p class="form-error" ng-show="editbookform.ISBN.$invalid && !editbookform.ISBN.$pristine">
                            {{trans('app.add-form.error.ISBN')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>Год издания:</span>
                    </div>
                    <div class="col-md-7">
                        <input type="number" ng-model="editbook.publication" class="form-control" min="0" step="1">
                    </div>
                </div>
                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>Описание: *</span>
                    </div>
                    <div class="col-md-7" ng-class="{ 'has-error' : editbookform.description.$invalid && !editbookform.description.$pristine}">
                        <textarea ng-model="editbook.description" class="form-control" name="description"  ng-maxlength="2000" required="required"></textarea>
                        <p class="form-error" ng-show="editbookform.description.$invalid && !editbookform.description.$pristine">
                            {{trans('app.add-form.error.description')}}
                        </p>
                    </div>
                </div>

                <div class="col-md-12 form-row">
                    <div class="col-md-4">
                        <span>Обложка: </span>
                    </div>
                    <div class="col-md-3" ng-if="editbook.img">
                        <img ng-src="@{{editbook.img}}" id="coverPreview" alt="@{{_book.description}}">
                    </div>
                    <div class="col-md-4" ng-class="{ 'has-error' : $uploaderror}">
                        <input upload id="cover" type="file" class="form-control" value="Загрузить">
                        <p class="form-error" ng-show="$uploaderror">
                            {{trans('app.add-form.error.upload')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-12 form-row">
                    <div class="col-md-7 col-md-offset-4" ng-class="{ 'has-error' : !$error}">
                        <p class="form-error" ng-repeat="msg in $errormsg"  ng-show="!$error && $errormsg.length > 0">
                            @{{msg}}
                        </p>
                        <p class="form-error" ng-show="!$error">
                            {{trans('app.add-form.error.error')}}
                        </p>
                    </div>
                </div>
                
                <div class="col-md-5 form-row pull-right">
                    <div class="col-md-4 pull-left">
                        <input type="submit" ng-click="submit()" class="form-control" ng-disabled="editbookform.$invalid" value="Сохранить">
                    </div>
                    <div class="col-md-4 pull-left">
                        <input type="button" ng-click="reset()" class="form-control" value="Очистить">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop