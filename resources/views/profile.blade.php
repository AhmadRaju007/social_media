@extends('layouts.main')

@section('center')
    <div class="col-sm-6">
        <form action="{{route('profile.edit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center" onmouseover="showUploadButton();" onmouseout="hideUploadButton();">
                <div class="form-group button-image">
                    <img class="img-circle" src="{{asset(auth()->user()->image?? '/images/no_user.jpg')}}">
                    <label onmouseover="showUploadButton();" class="btn btn-success image-upload" >
                        <input name="image" type="file" style="display: none;"/> Upload
                    </label>
                    <br><br>
                </div>
                <div class="form-group">
                    <button class="image-upload btn btn-success" style="display: none;" type="submit">Save</button>
                </div>
            </div>
        </form>

        <table style="width:100%; border: 1px solid #4CAF50;" class="table table-striped">
            <tr>
                <td><strong>First Name</strong></td>
                <td id="f_name">{{auth()->user()->fname}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('f_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Last Name</strong></td>
                <td id="l_name">{{auth()->user()->lname}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('l_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Birthday</strong></td>
                <td id="birthday">{{date('F j, Y', strtotime(auth()->user()->b_day))}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('birthday');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td id="email">{{auth()->user()->email}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('email');">
                        Edit
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('profile.update', auth()->user()->id)}}" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <h4><label id="fld_name" class="pull-right"></label></h4>
                                <input type="hidden" value="" name="fld_name" id="field">
                            </div>
                            <div class="col-sm-8">
                                <input class="form-group" type="text" value="" id="fld_value" name="fld_value">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        function setField(field_name){
            $('#fld_name').html(field_name.charAt(0).toUpperCase()+field_name.substr(1).toLowerCase());
            var field_value= $('#'+field_name).html();

            $('#fld_value').val(field_value);
            $('#field').val(field_name);
        }

        function hideUploadButton(){
            $('.image-upload').hide();
        }

        function showUploadButton(){
            $('.image-upload').show();
        }
    </script>
@endpush


