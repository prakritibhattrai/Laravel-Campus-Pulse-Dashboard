@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">

                    <div class="d-flex align-self-center">
                        <div class="flex-fill">

                            <p class="card-title-desc">Please do not modify until its necessary &#128515;</p>

                        </div>
                    </div>

                    <form action="{{ route('settings.update', $setting?->id) }}" id="settings" method="post">
                        @csrf
                        @method('put')
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-tachometer-alt"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-tachometer-alt me-2"></i>General</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#local" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-home me-2"></i>Local</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#mail" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-envelope"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-envelope me-2"></i>Mail</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#option" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-cogs"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-cogs me-2"></i>Option</span>
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="general" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="site_name" class="col-md-2 col-form-label">Website Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="site_name" placeholder="Enter website name" value="{{ $setting?->site_name }}" id="site_name"/>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="site_url" class="col-md-2 col-form-label">Website URL</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="site_url" placeholder="Enter website url" id="site_url" value="{{ $setting?->site_url }}" id="site_url"/>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="site_title" class="col-sm-2">Website Title</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="site_title" placeholder="Enter website title" value="{{ $setting?->site_title }}" id="site_title"/>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="copyright" class="col-md-2 col-form-label">Copyright</label>

                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="copyright" placeholder="Enter copyright" id="copyright" value="{{ $setting?->copyright }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="local" role="tabpanel">

                                <div class="mb-3 row">
                                    <label for="email" class="col-md-2 col-form-label">Email Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="email" name="email" placeholder="Enter email address" id="email" value="{{ $setting?->email }}"/>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="contact_number" class="col-md-2 col-form-label">Contact Number</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="number" name="contact_number" id="contact_number" placeholder="Enter contact number" value="{{ $setting?->contact_number }}" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="address" class="col-md-2 col-form-label">Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address" placeholder="Enter address" id="address" value="{{ $setting?->address }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="mail" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="mail_driver" class="col-sm-2 col-form-label">Mail Driver</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="mail_driver" id="mail_driver">
                                            <option value="smtp" @if($setting?->mail_driver == 'smtp') checked @endif>SMTP</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_host" class="col-sm-2 col-form-label">Mail Host</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="mail_host" id="mail_host" placeholder="Enter mail host" value="{{ $setting?->mail_host }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_username" class="col-sm-2 col-form-label">Mail Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="mail_username" id="mail_username" placeholder="Enter mail username" value="{{ $setting?->mail_username }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_password" class="col-sm-2 col-form-label">Mail Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="mail_password" id="mail_password" placeholder="Enter mail password" value="{{ $setting?->mail_password }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_port" class="col-sm-2 col-form-label">Mail Port</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="mail_port" id="mail_port" placeholder="Enter mail port" value="{{ $setting?->mail_port }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_from" class="col-sm-2 col-form-label">Mail From</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="mail_from" id="mail_from" placeholder="Enter mail from" value="{{ $setting?->mail_from }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mail_encryption" class="col-sm-2 col-form-label">Mail Encryption</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="mail_encryption" id="mail_encryption">
                                            <option value="tls" @if($setting?->mail_encryption == 'tls') selected @endif>TLS</option>
                                            <option value="ssl" @if($setting?->mail_encryption == 'ssl') selected @endif>SSL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="option" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="cache" class="col-sm-4 col-form-label">Enable Cache</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="cache" switch="success" name="cache" value="1" @if($setting->cache==1) checked @endif>
                                        <label for="cache" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="minify" class="col-sm-4 col-form-label">Minify HTML/CSS/JS</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="minify" switch="success" name="minify" value="1" @if($setting->minify==1) checked @endif>
                                        <label for="minify" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="maintenance" class="col-sm-4 col-form-label">Maintenance Mode</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="maintenance" switch="none" name="maintenance" value="1" @if($setting->maintenance==1) checked @endif>
                                        <label for="maintenance" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="use_ssl" class="col-sm-4 col-form-label">Use SSL</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="use_ssl" switch="success" name="use_ssl" value="1" @if($setting->use_ssl==1) checked @endif>
                                        <label for="use_ssl" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="app_debug" class="col-sm-4 col-form-label">App Debug</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="app_debug" switch="success" name="app_debug" value="1" @if($setting->app_debug==1) checked @endif>
                                        <label for="app_debug" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="google_recaptcha" class="col-sm-4 col-form-label">Google Recaptcha</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="google_recaptcha" switch="success" name="google_recaptcha" value="1" @if($setting->google_recaptcha==1) checked @endif>
                                        <label for="google_recaptcha" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="timezone" class="col-md-4 col-form-label">Timezone</label>
                                    <div class="col-md-8">
                                        @php
                                            $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                        @endphp
                                        <select class="form-control select2" name="timezone" id="timezone">
                                            <option value="">--Select--</option>
                                            @foreach($timezones as $key => $timezone)
                                                <option value="{{ $timezone }}" @if($timezone == $setting->timezone) selected @endif>{{ $timezone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
                <div
                <div class="card-footer">
                    <div class="flex-end">
                        <a class="btn btn-primary btn-sm btn-right" href="{{ route('settings') }}" onclick="event.preventDefault(); document.getElementById('settings').submit();">
                            <i class="fa fa-save"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
