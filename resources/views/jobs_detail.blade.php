@extends('layouts.reset')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 4% 0;">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $jobres->job_title }}</div>

                <div class="panel-body">
                    {{ strip_tags($jobres->job_desc) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
