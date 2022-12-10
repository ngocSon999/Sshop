@extends('web.layouts.master')
@section('style')
@endsection
@section('content')

            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Nội dung liên hệ</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="contact-form" data-url="{{route('web.add_contact')}}" class="contact-form row" name="contact-form" method="post">
                            @csrf
                            <div class="form-group col-md-6">
                                <input type="text" id="contact_name" name="name" class="form-control" required="required" {{old('name')}} placeholder="Tên">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" id="contact_email" name="email" class="form-control" required="required" {{old('email')}} placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" id="contact_phone" name="phone" class="form-control" required="required" {{old('phone')}} placeholder="Số điện thoại">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" id="contact_subject" name="subject" class="form-control" required="required" {{old('subject')}} placeholder="Tiêu đề">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="content" id="contact_content" required="required" class="form-control" rows="4" placeholder="Nội dung"> {{old('content')}}</textarea>
                            </div>
                            <div class=" form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right add_contact" value="Gửi">
                                <input style="margin-right: 10px" type="reset" class="btn btn-primary pull-right " value="Hủy">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper</p>
                            <p>999 abc -Việt Nam</p>
                            <p>Địa chỉ: {{getConfigSetting('address')}} </p>
                            <p>Mobile: {{getConfigSetting('phone')}}</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: {{getConfigSetting('email')}}</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Mạng xã hội</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function addContact(e){
            e.preventDefault()
            let url = $('#contact-form').attr('data-url')
            let contact_name = $('#contact_name').val()
            let contact_email = $('#contact_email').val()
            let contact_phone = $('#contact_phone').val()
            let contact_subject = $('#contact_subject').val()
            let contact_content = $('#contact_content').val()
            let _token = $('input[name="_token"]').val()
            $.ajax({
                type:'post',
                url:url,
                data:{
                    contact_name:contact_name,
                    contact_email:contact_email,
                    contact_phone:contact_phone,
                    contact_subject:contact_subject,
                    contact_content:contact_content,
                    _token:_token,
                },
                success: function (response){
                    alert('Gửi liên hệ thành công')
                    $('#contact_name').val('')
                    $('#contact_email').val('')
                    $('#contact_phone').val('')
                    $('#contact_subject').val('')
                    $('#contact_content').val('')
                },
                error: function (){

                },
            })
        }
    </script>
    <script>
        $(function (){
            $('.add_contact').on('click',addContact)
        })
    </script>
@endsection
