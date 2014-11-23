@extends('layouts.backend.default')

@section('content')

    @include('backend.partials.page-head', array(
        'pageTitle' => 'Profile',
        'pageTagline' => 'Manage all your account settings here!'
    ))

    <div class="dashboard-content light_grey ptb60">

        <div class="container-fluid settings-content">
            <div class="row-fluid">
                <div class="span10 offset1">

                    <div class="events-list p10" style="margin-bottom: 10px;">
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#personal-settings" data-toggle="tab">Personal Settings</a></li>
                                <li><a href="#account-settings" data-toggle="tab">Account Settings</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="personal-settings">
                                    <div class="row-fluid">
                                        <div class="span1"></div>
                                        <div class="span10">

                                            <h3 class="settings-head">Personal Settings</h3>

                                            <input type="text" name="fullname" id="fullname" placeholder="Full Name" />

                                            <input type="text" name="dob" id="dob" placeholder="Date of Birth" />

                                            <input type="text" name="address" id="address" placeholder="Address" />

                                            <input type="text" name="contact" id="contact" placeholder="Contact #" />

                                            <a class="button red-button" href="#">Save Changes</a>


                                            <div class="row-fluid">
                                                <div class="alert error">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <p>Invalid Username entered, it must not contain any spaces</p>
                                                    <p>Password must be 6 to 10 characters</p>
                                                    <p class="m0">Passwords don't match</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="span1"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account-settings">
                                    <div class="row-fluid">
                                        <div class="span1"></div>
                                        <div class="span10">

                                            <h3 class="settings-head">Account Settings</h3>

                                            <input type="text" name="email" id="email" placeholder="Email" readonly="readonly" />

                                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" />

                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" />

                                            <input type="password" name="re_new_password" id="re_new_password" placeholder="Retype New Password" />

                                            <a class="button red-button" href="#">Save Changes</a>

                                            <div class="row-fluid">
                                                <div class="alert error">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <p>Invalid Username entered, it must not contain any spaces</p>
                                                    <p>Password must be 6 to 10 characters</p>
                                                    <p class="m0">Passwords don't match</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="span1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="span1"></div>
            </div>
        </div>
    </div>
@stop