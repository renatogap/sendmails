@extends('layouts.default')
@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
    <div class="col">
        <a href="negocios" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-shop" style="font-size: 2rem; color: orangered"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Negócios</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="tags" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-tags-fill" style="font-size: 2rem; color: orangered"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Tags</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="templates" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-card-heading" style="font-size: 2rem; color: orangered;"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Templates</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="campanhas" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-boxes" style="font-size: 2rem; color: orangered;"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Campanhas</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="gatilhos" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-bullseye" style="font-size: 2rem; color: orangered;"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Gatilhos</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="envios" class="card">
            <div class="card-body">
                <div class="text-center">
                    <i class="bi bi-send-fill" style="font-size: 2rem; color: orangered;"></i>
                </div>
                <h5 class="card-title mt-2 text-center">Envios</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </a>
    </div>
</div>
@endsection