<?php
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>

<style type="text/css">
    body {
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }
    .glyphicon {
        font-size: 12px;
    }
    }
</style>

<script type='text/javascript'>//<![CDATA[
    var counter = 1;
    $(function() {
        //console.log($('#template_add_form'));
        var clone = function(tmpl) {
                return $((tmpl.clone()).html())
            },
            $template = $('#template_add_form'),
            formArray = [ clone($template) ], // init array with first row
            $formEntries = $('#entries');

        $(document).on('click', '.btn-add', function() {
            //console.log('clicked');
            formArray.push(clone($template));
            updateForm();
            counter++;
            // set focus to adding row = last element in array
            $(formArray).last()[0]
                .find('input')
                .first()
                .focus();
        });

        // remove not working yet

        $(document).on('click', '.btn-remove', function(evt) {
            var id;
            // iterate over formArray to find the currently clicked row
            counter--;
            $.each(formArray, function(index, row) {
                //console.log(index, row.has(evt.currentTarget).length);
                if ( row.has(evt.currentTarget).length == 1 ) {
                    //console.log(row.has(evt.currentTarget));
                    id = index; // click target in current row
                    return false; // exit each loop
                }

            });

            //console.log('clicked', id);
            formArray.splice(id, 1);
            updateForm();

        });

        $(document).ready(function(){
            $('#submit').click(function(e){
                e.preventDefault();
                var balanceArray = [];
                var rateArray = [];
                var paymentArray = []
                $('.balance').each(function(item){
                    balanceArray.push($(this).val());
                });
                $('.rate').each(function(item){
                    rateArray.push($(this).val());
                });
                $('.payment').each(function(item){
                    paymentArray.push($(this).val());
                });
            });
        });

        var updateForm = function() {
            // redraw form --> problem values are cleared!!
            // console.log(formArray);
            var lastIndex = formArray.length - 1,
                name; // stores current name of input

            $formEntries.empty(); // clear entries from DOM becaue we re-create them
            $.each(formArray, function(index, $input) {
                //console.log(index, $input);
                // update names of inputs and add index
                //console.log('inputs', $input.find('input'));
                $.each($input.find('input'), function(inputIndex, input) {
                    name = $(input).attr('name').replace(/\d+/g, ''); // remove ids
                    $(input).attr('name', name + index);
                });

                if (index < lastIndex) {
                    // not last element --> change button to minus
                    //console.log($input.find('.btn-add'));
                    $input.find('.btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="glyphicon glyphicon-minus"></span>');
                }

                $formEntries.append($input);
                $('#counter').val(counter);
            });
        };

        updateForm(); // first init. of form

    });
    //]]>

</script>

<form id="loanform" action="#" role="form" autocomplete="off" method="post">
    <INPUT type="hidden" name="action" value="cancel">
    <script id="template_add_form" type="text/template">
        <div class = "entry input-group col-xs-9">
            <div class = "col-xs-3">
                <input class = "form-control" name="balance" type = "text"
                       placeholder = "Loan Balance" required = "required"/>
            </div>
            <div class="col-xs-3">
                <input class="form-control" name="rate" type="text" placeholder="Interest Rate" required="required" />
            </div>
            <div class="col-xs-3">
                <input class="form-control" name="payment" type="text" placeholder="Minimum Payment" required="required"/>
            </div>
            <span class="input-group-btn col-xs-1">
            <button class="btn btn-success btn-add" type="button">
                <span class="glyphicon glyphicon-plus"></span >
            </button>
        </span>
        </div>
    </script>
    <div class="container">
        <div class="row">
            <div class="control-group" id="fields">
                <label class="control-label" for="field1">
                    <h3>Enter your loans below</h3>

                </label>
                <div class="controls">
                    <div class="entry input-group col-xs-3">How much extra money can you pay per month?
                        <input class="form-control" name="extra" type="text" placeholder="Extra/month">
                    </div>
                    <br>
                    <div id="entries"></div>
                </div>
                <div class="input-group-btn">
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <br> <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another loan</small>
            </div>
        </div>
    </div>
</form>
