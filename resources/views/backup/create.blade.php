<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.create')}} {{ trans('tomato-backup::global.title') }}</h1>

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.backup.store')}}" method="post">

        <x-splade-radios name="type" :label="trans('tomato-backup::global.type')"  :options="[
            'db' => trans('tomato-backup::global.db'),
            'files' => trans('tomato-backup::global.files'),
            'database_files' => trans('tomato-backup::global.database_files'),
        ]"/>

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{trans('tomato-backup::global.title')}}" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
