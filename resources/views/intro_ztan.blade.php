@extends('layouts.master_clean')

@section('page-title', '職探中心簡介')

@section('content')
    <div class="row">

            <div class="col-12">
                <div class="content-info">
                    <h2>{{ $user->name }}簡介</h2>
                    <div class="card">
                        <div class="card-header">
                            內容
                        </div>
                        <div class="card-body">
                            <?php
                                $intro_ztan = nl2br($user->intro_ztan);
                            ?>
                            {!! $intro_ztan !!}
                        </div>
                    </div>

                </div>

            </div>

    </div>
@endsection