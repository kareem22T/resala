@extends('site.layouts.site-layout')

@section('title', 'الفروع' )
@section('branches_active', 'active')

@section('styles')
<style>
    .branches_wrapper {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 5rem 0 3rem;
    }
    .branches_wrapper .card {
        color: #ffffff;
        background-color: #27318b;
        padding: 1rem;
        margin-bottom: 0px;
        border-radius: 10px;
        box-shadow: 1px 10px 32px 0px rgba(72,41,160,0.15);
        border: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .branches_wrapper .card h2 {
        display: flex;
        flex-direction: column;
        font-size: 22px;
        font-weight: 700;
        line-height: 30px;
    }

    .branches_wrapper .card h2 span {
        font-size: 16px;
        font-weight: 500;
    }

    .branches_wrapper .card >* {
        display: flex;
        gap: 1rem
    }

    .branches_wrapper .card >* i {
        font-size: 29px;
        color: #ffffff;
        background-color: rgba(255,255,255,0.05);
        margin-right: 10px;
        gap: 1rem;
        border-radius: 4px;
        height: max-content;
        padding: 10px;
    }
        .pagination {
        margin: 2rem auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        direction: ltr !important
    }
    .page-link {
        border-radius: 10px !important;
        width: 40px;
        height: 40px;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #27318b !important;
    }
    .page-item.active .page-link {
        background: #e31b24;
        color: #fff !important;
        border-color: #e31b24 !important;
    }

    @media (max-width: 767.98px) {
        .branches_wrapper {
            grid-template-columns: 1fr
        }
    }
</style>
@endsection

@section('content')
    @if($branches && $branches->count() > 0)
        <div class="branches_wrapper">
            @foreach ($branches as $branch)
                <div class="card">
                    <div class="address">
                        <i class="fa-solid fa-earth-africa"></i>
                        <h2>
                            {{ $branch->location }}
                            <span>{{ $branch->address }}</span>
                        </h2>
                    </div>
                    <div class="phone" style="margin-top: 10px;align-items:center;">
                        <i class="fa-solid fa-phone-flip"></i>
                        {{$branch->phone}}
                    </div>                    
                </div>
            @endforeach
        </div>

        <div class="pagination_wrapper">
            {!! $branches->links('pagination::bootstrap-4') !!}
        </div>
    @else
    <h1 style="margin: 5rem 0">
        لا توجد فروع
    </h1>
    @endif
@endsection
