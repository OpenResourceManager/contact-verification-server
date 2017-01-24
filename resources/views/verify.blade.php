@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form class="form-horizontal" data-toggle="validator" name="token_form"
                              id="verify_token_form" role="form" method="POST" action="{{ url('/verify') }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
                                <div class="col-md-9">
                                    <input type="text" placeholder="Verification Token" class="form-control" name="token"
                                           value="{{ old('token') }}" required>
                                    <div class="help-block with-errors"></div>
                                    @if ($errors->has('token'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 col-md-offset-1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-btn fa-paper-plane"></i>Submit
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <!--  <script src="/js/validator.min.js"></script>
    <script type="text/javascript">
      $('#verify_token_form').validator();
    </script>-->
@endsection