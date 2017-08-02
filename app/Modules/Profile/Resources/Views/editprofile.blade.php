@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<style>
    .dropdown{
        height: 36px;
    }
    .inputField{
        width: 100%;
    }
    .parsley-required{
        color: red;
    }
</style>
<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>
    </div>
    <div class="box pad ">
        {{ Form::open(array('url' => '#', 'method' => 'post', 'id' => 'editProfile')) }}
        <div class="thick-text">Edit profile</div>
        <div class="accordion-group">
            <div class="accordion">
                <div class="accordion-title">Personal Details</div>
                <div class="accordion-content" style="display: block;">
                    <div class="formRow">
                        <label>Motto</label>
                        <div><input type="text" name="motto" value="{{$data['motto_name']->name or ''}}" required></div> 
                    </div>
                    <div class="formRow">
                        @if(count($data['gender_preference'])>0)
                        <label>Your Gender & Preference</label>
                        @foreach($data['gender_preference'] as $val)
                        <div class="radioRow"><input type="radio" name="gender_preference_id" value="{{$val->id}}"><label>{{$val->gender_preference_name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        @if(count($data['marital_status'])>0)
                        <label>What is your marital status?</label>
                        @foreach($data['marital_status'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->marital_status}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        <label>Height</label>
                        <div class="radioRow">{!! Form::select('height', $data['height'], [], ['class' => 'dropdown', 'required']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>If you are NRI choose your ethnic origin</label>
                        <div class="radioRow">{!! Form::select('ethnic_origin', $data['ethnic_origin'], [], ['class' => 'dropdown', 'required','id'=>'ethnic_origin']) !!}</div> 
                    </div>
                    <div class="formRow">

                        @if(count($data['marital_status'])>0)
                        <label>Hightest level of qualification</label>

                        @foreach($data['qualification'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->qualification_name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Personal Appearance</div>
                <div class="accordion-content" style="display: none;">
                    <div class="formRow">

                        <label>Core Area</label>
                        <div class="radioRow">
                            <select style="width:300px" id="core_area_job">
                                @if(count($data['jobs'] >0))
                                @foreach($data['jobs'] as $key =>$value)
                                <optgroup label="{{$value['category_name']}}">
                                    @foreach($value['jobs'] as $jobKey =>$jobValue)
                                    <option value="{{$jobValue['job_id']}}">{{$jobValue['job_name']}}</option>                                    
                                    @endforeach  
                                </optgroup>
                                @endforeach
                                @endif
                            </select   
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Job Title</label>
                        <div><input type="text" name="motto" value="" required></div> 
                    </div>
                    <div class="formRow">
                        <label>Zodiac Signs</label>
                        <div><input type="text" name="motto" value="{{$data['motto_name']->name or ''}}" required></div> 
                    </div>

                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Social &amp; Lifestyle</div>
                <div class="accordion-content" style="display: none;">
                    <div class="formRow">

                        @if(count($data['smoke'])>0)
                        <label>Smoke :</label>

                        @foreach($data['smoke'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">

                        @if(count($data['smoke'])>0)
                        <label>Drink :</label>

                        @foreach($data['drink'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">

                        @if(count($data['pet_lover'])>0)
                        <label>Pet Lover:</label>

                        @foreach($data['pet_lover'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>


                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Personality Traits</div>
                <div class="accordion-content" style="display: none;">
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Tell us what you would like us partner </div>
                <div class="accordion-content" style="display: none;">
                    <div class="formRow">
                        <label>I'm seeking a</label>
                        <div class="radioRow"><input type="radio" name="marital_status_id" value=""><label>Male</label></div> 
                        <div class="radioRow"><input type="radio" name="marital_status_id" value=""><label>Female</label></div> 
                    </div>
                    <div class="formRow">
                        <label>Age</label>
                        <div class="radioRow">
                            <input type="number" style="width: 106px;" name="age" value="18" min="18"> To
                            <input type="number"  style="width: 106px;"  name="age" value="18" min="18">
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Height</label>
                        <div class="radioRow">
                            <input type="number" style="width: 106px;" name="age" value="18" min="18"> To
                            <input type="number"  style="width: 106px;"  name="age" value="18" min="18">
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Marital Status</label>
                        <div class="radioRow">{!! Form::select('partner_marital_status', $data['partner_marital_status'], [], ['class' => 'dropdown', 'required','id'=>'partner_marital_status','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Country living in</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['living_country'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>State living in</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['states'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Residential status</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['living_country'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Country grew up in</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['living_country'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Education</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['living_country'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Profession Area</label>
                        <div class="radioRow">{!! Form::select('living_country', $data['living_country'], [], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Annual Income</label>
                        <div class="radioRow"><input type="text" name="motto" value="" required></div> 
                    </div>
                    <div class="formRow">
                        <label>Please indicate which smoking habits you would accept from your partner.</label>
                        <div class="radioRow">
                            <select style="width:300px" id="smoking_habits">
                                <option value="never">Never</option>  
                                <option value="a_few_times_a_year">A few times a year</option>  
                                <option value="about_once_a_week">About once a week</option>  
                                <option value="a_few_times_a_week">A few times a week</option>  
                                <option value="every_day">Every day</option>  
                            </select>
                        </div> 

                    </div>
                    <div class="formRow">

                        <label>Please indicate which drinking habits you would accept from your partner.</label>
                        <div class="radioRow">
                            <select style="width:300px" id="smoking_habits">
                                <option value="never">Never</option>  
                                <option value="several_times_a_year">Several times a year</option>  
                                <option value="about_once_a_week">About once a week</option>  
                                <option value="a_few_times_a_week">A few times a week</option>  
                                <option value="every_day">Every day</option>  
                            </select>
                        </div> 

                    </div>
                    <div class="formRow">

                        <label>How many children up to the age of 18 currently live in your household?</label>
                        <div class="radioRow"><input type="text" name="motto" value="" required></div> 

                    </div>
                    <div class="formRow">
                        <label>Could you imagine having children or adopting with your partner and raising a family?</label>
                        <div class="radioRow">
                            <select style="width:300px" id="smoking_habits">
                                <option value="yes">Yes</option>  
                                <option value="may_be">Maybe</option>  
                                <option value="no">No</option>  
                            </select>
                        </div> 

                    </div>
                    <div class="formRow">
                        <label>Would you accept a partner who has children under the age of 18 in her household?</label>
                        <div class="radioRow">
                            <input type="radio" name="marital_status_id" value="yes"><label>Yes</label>
                            <input type="radio" name="marital_status_id" value="no"><label>No</label>
                        </div> 
                    </div>

                </div>
            </div>

            <div class="flex-item text-right">
                <label id="result"></label>
                <input type="button" name="editpic" class="button" value="Submit" onclick="updateProfile()">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endsection

@section('js')
<script>
    $('select').select2({
        minimumResultsForSearch: -1
    });
    $('#ethnic_origin').select2({
    });
    $('#smoking_habits').select2({
    });


    $("#core_area_job").select2({
        placeholder: "Select a core area",
        allowClear: true
    });
    function updateProfile() {
        $('#editProfile').parsley().validate();
        if ($('#editProfile').parsley().isValid()) {
            $.ajax({
                url: "{{URL::to('profile/update')}}",
                type: "POST",
                dataType: "json",
                data: $('#editProfile').serialize(),
                success: function (data) {
                    $("#result").html(data.msg);
                    setTimeout(function () {
                        $("#result").hide('slow');
                    }, 6000);
                }
            });
        }
    }
</script>
@endsection