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
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => $inputText)) }}
                                </div>
                            </div>

                            <div class="form-group input-row">
                                {{ Form::label('notes', 'Notes') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                    {{ Form::text('notes', null, array('class' => 'form-control', 'placeholder' => $inputText)) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group input-row">
                                {{ Form::label('companies_id', 'Invoice between company:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
                                    {{ Form::select('companies_id', $dataOfCompanies, null, ['class' => 'form-control', 'placeholder' => $inputText])  }}
                                </div>
                            </div>

                            <div class="form-group input-row">
                                {{ Form::label('client_id', 'Invoice between client:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
                                    {{ Form::select('client_id', $dataOfClient, null, ['class' => 'form-control', 'placeholder' => $inputText])  }}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="page-header">
                Add Products
            </h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group input-row">
                                {{ Form::label('product_id', 'Choose product:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
                                    {{ Form::select('product_id', $dataOfProducts, null, ['class' => 'form-control', 'placeholder' => $inputText])  }}
                                </div>
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('cost', 'Cost') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    {{ Form::text('cost', null, array('class' => 'form-control', 'placeholder' => $inputText)) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group input-row">
                                {{ Form::label('amount', 'Amount') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                                    {{ Form::text('amount', null, array('class' => 'form-control', 'placeholder' => $inputText)) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 validate_form">
                            {{ Form::submit('Add invoice', array('class' => 'btn btn-primary')) }}
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
                    var error_message_field = $('.error_message', field.parent('.input-group'));

                    //if the error message field doesn't exist yet, add it
                    if (!error_message_field.length) {
                        error_message_field = $('<span/>').addClass('error_message');
                        field.parent('.input-group').append(error_message_field);
                    }

                    error_message_field.text(message).show(200);
                    field.addClass('error');
                },
                //this removes an error from a form field
                removeError: function (field) {
                    $('.error_message', field.parent('.input-group')).text('').hide();
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

                    'amount': {
                        'field': $('input[name=amount]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A amount is required."

                            };

                            var number_pattern = /[0-9]$/i;
                            if (!number_pattern.test(field.val())) {
                                throw "amount items a number.";
                            }
                        }
                    },
                    'notes': {
                        'field': $('input[name=notes]'),
                        'validate': function (field, event) {
                            if (!field.val()) {
                                throw "A notes is required.";
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