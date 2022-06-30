@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-movies.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_movies.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_movies.inputs.name')</h5>
                    <span>{{ $movies->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_movies.inputs.description')</h5>
                    <span>{{ $movies->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_movies.inputs.date')</h5>
                    <span>{{ $movies->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_movies.inputs.genres_id')</h5>
                    <span>{{ optional($movies->genres)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('all-movies.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Movies::class)
                <a
                    href="{{ route('all-movies.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
