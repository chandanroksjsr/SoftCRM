@extends('layouts.base')

@section('caption', 'Add invoices')

@section('title', 'Add invoices')

@section('lyric', 'lorem ipsum')

@section('content')
    @if(count($dataOfCompanies) == 0)
        <div class="alert alert-danger">
            <strong>Danger!</strong> There is no companies in system. Please create any client.
            <a href="{{ URL::to('companies/create') }}">Click here!</a>
        </div>
    @endif
    @if(count($dataOfClient) == 0)
        <div class="alert alert-danger">
            <strong>Danger!</strong> There is no client in system. Please create any client.
            <a href="{{ URL::to('client/create') }}">Click here!</a>
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if(session()->has('message_success'))
        <div class="alert alert-success">
            <strong>Well done!</strong> {{ session()->get('message_success') }}
        </div>
    @elseif(session()->has('message_danger'))
        <div class="alert alert-danger">
            <strong>Danger!</strong> {{ session()->get('message_danger') }}
        </div>
    @endif

    <!-- /. ROW  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::open(array('url' => 'invoices')) }}
                            <div class="form-group input-row">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('type', 'Type') }}
                                {{ Form::text('type', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('number', 'Number') }}
                                {{ Form::text('number', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group input-row">
                                {{ Form::label('companies_id', 'Invoice between company:') }}
                                {{ Form::select('companies_id', $dataOfCompanies, null, ['class' => 'form-control'])  }}
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('client_id', 'Invoice between client:') }}
                                {{ Form::select('client_id', $dataOfClient, null, ['class' => 'form-control'])  }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>#1</h3>
                            <br>
                            <div class="form-group input-row">
                                {{ Form::label('subject', 'Subject') }}
                                {{ Form::text('subject', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('cost', 'Cost') }}
                                {{ Form::text('cost', null, array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h3>#2</h3>
                            <br>
                            <div class="form-group input-row">
                                {{ Form::label('notes', 'Notes') }}
                                {{ Form::text('notes', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('amount', 'Amount') }}
                                {{ Form::text('amount', null, array('class' => 'form-control')) }}
                            </div>

                        </div>
                        <div class="col-lg-12 validate_form">
                            {{ Form::submit('Submit Button', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>
    <script>
        $(document).ready(function () {
            //create formValidator object
            //there are a lot of configuration options that need to be passed,
            //but this makes it extremely flexibility and doesn't make any assumptions
            var validator = new formValidator({
                //this function adds an error message to a form field
                addError: function (field, message) {
                    //get existing error message field
                    var error_message_field = $('.error_message', field.parent('.input-row'));

                    //if the error message field doesn't exist yet, add it
                    if (!error_message_field.length) {
                        error_message_field = $('<span/>').addClass('error_message');
                        field.parent('.input-row').append(error_message_field);
                    }

                    error_message_field.text(message).show(200);
                    field.addClass('error');
                },
                //this removes an error from a form field
                removeError: function (field) {
                    $('.error_message', field.parent('.input-row')).text('').hide();
                    field.removeClass('error');
                },
                //this is a final callback after failing to validate one or more fields
                //it can be used to display a summary message, scroll to the first error, etc.
                onErrors: function (errors, event) {
                    //errors is an array of objects, each containing a 'field' and 'message' parameter
                },
                //this defines the actual validation rules
                rules: {
                    //this is a basic non-empty check
                    'name': {
                        'field': $('input[name=name]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A name is required.";
                            }
                        }
                    },
                    'type': {
                        'field': $('input[name=type]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A type is required.";
                            }
                        }
                    },
                    'number': {
                        'field': $('input[name=number]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A number is required."

                            }
                            ;

                            var number_pattern = /[0-9]$/i;
                            if (!number_pattern.test(field.val())) {
                                throw "Please enter a number.";
                            }
                        }
                    },
                    'subject': {
                        'field': $('input[name=subject]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A subject is required.";
                            }
                        }
                    },
                    'cost': {
                        'field': $('input[name=cost]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A cost is required."

                            }
                            ;

                            var const_pattern = /[0-9]$/i;
                            if (!const_pattern.test(field.val())) {
                                throw "Please enter a cost.";
                            }
                        }
                    }

                }
            });

            //now, we attach events

            //this does validation every time a field loses focus
            $('form').on('blur', 'input,select', function () {
                validator.validateField($(this).attr('name'), 'blur');
            });

            //this clears errors every time a field gains focus
            $('form').on('focus', 'input,select', function () {
                validator.clearError($(this).attr('name'));
            });

            //this is for the validate links
            $('.validate_section').click(function () {
                var fields = [];
                $('input,select', $(this).closest('.section')).each(function () {
                    fields.push($(this).attr('name'));
                });

                if (validator.validateFields(fields, 'submit')) {
                    alert('success');
                }
                return false;
            });
            $('.validate_form').click(function () {
                if (!validator.validateFields('submit')) {
                    return false;
                }
                return true;
            });

            //this is for the clear links
            $('.clear_section').click(function () {
                var fields = [];
                $('input,select', $(this).closest('.section')).each(function () {
                    fields.push($(this).attr('name'));
                });

                validator.clearErrors(fields);
                return false;
            });
        });
    </script>
@endsection