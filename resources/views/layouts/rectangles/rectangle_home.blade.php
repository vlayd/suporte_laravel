<div class="col-lg-3 px-2 col-12 mt-3">
    <div class="card border-1 bg-{{$color}} shadow-lg">
        <div class="card-body p-3 position-relative shadow-lg">
            <div class="row">
                <div class="col" id="total_{{$status}}">
                    <div class="numbers text-center">
                        <p class="fs-1 mb-0 font-weight-bold text-white">
                            <span class="mes_30 {{$status}}">{{$value30}}</span>
                            <span class="mes_todos d-none {{$status}}">{{$value}}</span>
                        </p>
                        <div class="font-weight-bolder mb-0 h5 text-white">
                            {{$title}}
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.badges.badge_nao_visto', ['value' => $valueNaoVisto, 'id' => $status])
        </div>
    </div>
</div>
