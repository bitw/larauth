@extends(Config::get('larauth::template'))

@section(Config::get('larauth::out'))
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('larauth::larauth.request_code')}}</div>
            <div class="panel-body">
                {{Form::open(['route'=>'larauth.requestcode', 'role'=>'form', 'class'=>'form-horizontal'])}}
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">{{trans('larauth::larauth.email')}}</label>
                        <div class="col-md-8">
                            <?=Form::email('email', null, ['required'=>true, 'class'=>'form-control'])?>
                        </div>
                    </div>
                    @if($errors->count())
                        <div class="alert alert-danger">
                            {{implode('', $errors->all('<div>:message</div>'))}}
                        </div>
                    @endif
                    <div class="col-md-12">
                        {{Form::submit(trans('larauth::larauth.request'), ['class'=>'btn btn-primary col-md-12'])}}
                    </div>
                {{Form::close()}}
                <div class="col-md-12 text-center">
                    {{link_to_route('larauth.logon', trans('larauth::larauth.authorization'), [], ['class'=>'btn btn-link btn-sm'])}}
                    {{link_to_route('larauth.registration', trans('larauth::larauth.registration'), [], ['class'=>'btn btn-link btn-sm'])}}
                    {{link_to_route('larauth.activation', trans('larauth::larauth.activation'), [], ['class'=>'btn btn-link btn-sm'])}}
                </div>
            </div>
        </div>
    </div>
@endsection