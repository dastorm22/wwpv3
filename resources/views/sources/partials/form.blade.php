<div class="col-sm-6">
@component('partials.components.card-box')
    @slot('title', 'Source Information')

    <div class="row m-t-40">
        <div class="col-md-12">
            @component('partials.components.form-group-horizontal')
                @slot('label', 'Name')
                @include('partials.forms.input',[
                    'name' => 'name',
                    'value' => $source->name,
                    'required' => true
                ])
            @endcomponent

            @component('partials.components.form-group-horizontal')
                @slot('label', 'Type')
                @include('partials.forms.select-array', [
                    'name' => 'type',
                    'options' => $types,
                    'selected' => $source->type,
                    'required' => true,
                    'class' => 'select2'])
            @endcomponent

            @component('partials.components.form-group-horizontal')
                @slot('label', 'URL')
                @include('partials.forms.input',[
                    'name' => 'url',
                    'value' => $source->url,
                ])
            @endcomponent

            @component('partials.components.form-group-horizontal')
                @slot('label', 'File')
                @include('partials.forms.file',[
                    'name' => 'file',
                ])
            @endcomponent

            <hr>

            @component('partials.components.form-group-horizontal')
                @slot('label', 'Enabled')
                @include('partials.forms.switch', [
                    'name'=>'is_enabled',
                    'checked' => $source->is_enabled ?? null,
                    'label' => 'Disabled sources will not be processed.'
                ])
            @endcomponent

            <hr>

            @component('partials.components.form-group-horizontal')
                @slot('label', 'Main Source')
                @include('partials.forms.switch', [
                    'name'=>'is_main',
                    'checked' => $source->is_main ?? null,
                    'label' => 'Only one source can be the main one.'
                ])
            @endcomponent

            <hr>

            @component('partials.components.form-group-horizontal')
                @slot('label', 'Enable Exploration')
                @include('partials.forms.switch', [
                    'name'=>'include_in_explore',
                    'checked' => $source->include_in_explore ?? null,
                    'label' => 'Use this source in the Exploration analysis. '
                ])
            @endcomponent

        </div>
    </div>
@endcomponent
</div>

<div class="col-sm-6">
    @component('partials.components.card-box')
        @slot('title', 'File Settings')

        <div class="row m-t-40">
            <div class="col-md-12">
                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Rows to Skip')
                    @include('partials.forms.input',[
                        'name' => 'skip_rows',
                        'value' => $source->skip_rows ?? 0,
                        'required' => true,
                    ])
                @endcomponent

                <hr>

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'UPC')
                    @include('partials.forms.select-array', [
                        'name' => 'column_upc',
                        'options' => $columns,
                        'selected' => $source->column_upc,
                        'required' => true,
                        ])
                @endcomponent

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Name')
                    @include('partials.forms.select-array', [
                        'name' => 'column_name',
                        'options' => $columns,
                        'selected' => $source->column_name,
                        'required' => true,
                        ])
                @endcomponent

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Price')
                    @include('partials.forms.select-array', [
                        'name' => 'column_price',
                        'options' => $columns,
                        'selected' => $source->column_price,
                        'required' => true,
                        ])
                @endcomponent

                <hr>

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'SKU')
                    @include('partials.forms.select-array', [
                        'name' => 'column_sku',
                        'options' => $columns,
                        'selected' => $source->column_sku,
                        ])
                @endcomponent

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Brand')
                    @include('partials.forms.select-array', [
                        'name' => 'column_brand',
                        'options' => $columns,
                        'selected' => $source->column_brand,
                        ])
                @endcomponent

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Category')
                    @include('partials.forms.select-array', [
                        'name' => 'column_category',
                        'options' => $columns,
                        'selected' => $source->column_category,
                        ])
                @endcomponent

                @component('partials.components.form-group-horizontal')
                    @slot('label', 'Stock')
                    @include('partials.forms.select-array', [
                        'name' => 'column_stock',
                        'options' => $columns,
                        'selected' => $source->column_stock,
                        ])
                @endcomponent



            </div>
        </div>
    @endcomponent
</div>

