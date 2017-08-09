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
    
    
    .cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}

.cc-selector-2 input{
    position:absolute;
    z-index:999;
}

.cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
.cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
    -webkit-filter: none;
       -moz-filter: none;
            filter: none;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    width:100px;height:70px;
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);
}
.drinkcard-cc:hover{
    -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
       -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
            filter: brightness(1.2) grayscale(.5) opacity(.9);
}
    
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php
$profile = $data['user_profiles'];
?>
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
                <div class="accordion-content" style="display: none;">
                    <div class="formRow">
                        <label>Motto</label>
                        <div><input type="text" name="motto" id="motto_id" value="{{$profile['motto'] or ''}}" required></div> 
                    </div>
                    <div class="formRow">
                        @if(count($data['gender_preference'])>0)
                        <label>Your Gender & Preference</label>
                        @foreach($data['gender_preference'] as $val)
                        <div class="radioRow"><input type="radio" name="gender_preference_id" <?php echo ($profile['gender_preference_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->gender_preference_name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        @if(count($data['marital_status'])>0)
                        <label>What is your marital status?</label>
                        @foreach($data['marital_status'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" <?php echo ($profile['marital_status_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->marital_status}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        <label>Height</label>
                        <div class="radioRow">{!! Form::select('height', $data['height'], [$profile['marital_status_id']], ['class' => 'dropdown', 'required']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>If you are NRI choose your ethnic origin</label>
                        <div class="radioRow">{!! Form::select('ethnic_origin_id', $data['ethnic_origin'], [$profile['ethnic_origin_id']], ['class' => 'dropdown', 'required','id'=>'ethnic_origin']) !!}</div> 
                    </div>
                    <div class="formRow">

                        @if(count($data['marital_status'])>0)
                        <label>Hightest level of qualification</label>

                        @foreach($data['qualification'] as $val)
                        <div class="radioRow"><input type="radio" name="qualification_id" <?php echo ($profile['qualification_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->qualification_name}}</label></div> 
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
                            <select style="width:300px" id="job_category_id" name="job_category_id">
                                @if(count($data['jobs'] >0))
                                @foreach($data['jobs'] as $key =>$value)
                                <optgroup label="{{$value['category_name']}}">
                                    @foreach($value['jobs'] as $jobKey =>$jobValue)
                                    <option <?php echo ($profile['job_category_id'] == $jobValue['job_id']) ? 'selected="selected"' : '' ?> value="{{$jobValue['job_id']}}">{{$jobValue['job_name']}}</option>                                    
                                    @endforeach  
                                </optgroup>
                                @endforeach
                                @endif
                            </select>  
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Job Title</label>
                        <div><input type="text" name="job_title" value="{{$profile['job_title']}}" ></div> 
                    </div>
                    <div class="formRow zodiStyle">
                        <h3>Zodiac Signs</h3>
                        <div class="row">
                            <div class="col-md-12">
                            @if(count($data['zodiac_signs']) > 0)
                                @foreach($data['zodiac_signs'] as $value)
                                <?php 
                                $url = asset("images/zodiac-signs/".$value->sign_image_url);
                                $zodiac_name = strtolower($value->zodiac_name);
                                echo '<style>.'.$zodiac_name.'{background:url('.$url.') no-repeat center center ; background-size:auto 100%; positon:relative; display:inline-block; }</style>';
                                ?>
                                <div class="cc-selector text-center zodicSingle">
                                    <input <?php echo ($profile['zodiac_sign_id'] == $value->id)?'checked="checked"':''?>  id="{{$zodiac_name}}" type="radio" name="zodiac_sign_id" value="{{$value->id}}" />
                                    <label class="drinkcard-cc {{$zodiac_name}}" for="{{$zodiac_name}}"><span>{{$zodiac_name}}</span></label>
                                </div>
                                @endforeach
                            @endif
                            </div>
                            </div>
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
                        <div class="radioRow"><input type="radio" name="smoke_id" <?php echo ($profile['smoke_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        @if(count($data['drink'])>0)
                        <label>Drink :</label>
                        @foreach($data['drink'] as $val)
                        <div class="radioRow"><input type="radio" name="drink_id" <?php echo ($profile['drink_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        @if(count($data['pet_lover'])>0)
                        <label>Pet Lover:</label>
                        @foreach($data['pet_lover'] as $val)
                        <div class="radioRow"><input type="radio" name="pet_lover_id" <?php echo ($profile['pet_lover_id'] == $val->id) ? 'checked="checked"' : '' ?> value="{{$val->id}}"><label>{{$val->name}}</label></div> 
                        @endforeach
                        @endif
                    </div>


                </div>
            </div>
            
            
            <?php $traits = []?>
            <div class="accordion">
                <div class="accordion-title">Personality Traits</div>
                
                <div class="accordion-content" style="display: none;">
                    @if(count($data['traits'])>0)
                        @foreach($data['traits'] as $key => $value)
                            <label><b>{{ucwords(str_replace('_', ' ', $value['category']))}}</b></label>
                            <div class="lists{{$value['category']}} traits" id="{{$value['category']}}">
                                <?php $traits[$value['category']] = '';?>
                                @foreach($value['traits'] as $val)
                                    <!--<div>{{$val['name']}}</div>--> 
                                    <?php $traits[$value['category']] .= '<div class="col-md-4 traits-box" data-id="'.$val['id'].'" data-category="'.$val['category'].'" class="lists'.$value['category'].'">'.$val['name'].'</div>';?>
                                @endforeach
                            </div>
                            
                            <label><b>{{ucwords(str_replace('_', ' ', $value['category']))}} Selected</b></label>
                            <div class="lists{{$value['category']}} traits-selected" id="{{$value['category']}}_sel">
                                
                                
                            </div>
                            
                        @endforeach
                    @endif
                    <div class="clearfix"></div>
                       
                </div>
            </div>
            
            <div class="accordion">
                <div class="accordion-title">Tell us what you would like us partner </div>
                <div class="accordion-content" style="display: none;">
                    <div class="formRow">
                        <label>I'm seeking a</label>
                        <div class="radioRow"><input type="radio" name="partner_gender" <?php echo ($profile['partner_gender'] == 'male') ? 'checked="checked"' : '' ?> value="male"><label>Male</label></div> 
                        <div class="radioRow"><input type="radio" name="partner_gender" <?php echo ($profile['partner_gender'] == 'female') ? 'checked="checked"' : '' ?> value="female"><label>Female</label></div> 
                    </div>
                    <div class="formRow">
                        <label>Age</label>
                        <div class="radioRow">
                            <input type="number" style="width: 106px;" name="age_from" value="{{$profile['age_from']}}" min="18"> To
                            <input type="number"  style="width: 106px;"  name="age_to" value="{{$profile['age_to']}}" min="18">
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Height</label>
                        <div class="radioRow">
                            <input type="number" style="width: 106px;" name="height_from" value="{{$profile['height_from']}}"> To
                            <input type="number"  style="width: 106px;"  name="height_to" value="{{$profile['height_to']}}">
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Marital Status</label>
                        <div class="radioRow">{!! Form::select('partner_marital_status[]', $data['partner_marital_status'], $data['selected_partner_marital_status'], ['class' => 'dropdown', 'required','id'=>'partner_marital_status','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Country living in</label>
                        <div class="radioRow">{!! Form::select('partner_living_country[]', $data['living_country'], $data['selected_partner_living_country'], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>State living in</label>
                        <div class="radioRow">{!! Form::select('partner_living_state[]', $data['states'], $data['selected_partner_living_state'], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Residential status</label>
                        <div class="radioRow">{!! Form::select('partner_grew_up_country[]', $data['living_country'], $data['selected_partner_grew_up_country'], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Country grew up in</label>
                        <div class="radioRow">{!! Form::select('partner_grew_up_country[]', $data['living_country'], $data['selected_partner_grew_up_country'], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Education</label>
                        <div class="radioRow">{!! Form::select('partner_qualification[]', $data['partner_qualification'], $data['selected_partner_qualification'], ['class' => 'dropdown', 'required','id'=>'living_country','multiple'=>'multiple']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>Profession Area</label>
                        <div class="radioRow">
                            <select style="width:300px" name="partner_job_category[]" multiple="">
                                @if(count($data['jobs'] >0))
                                @foreach($data['jobs'] as $key =>$value)
                                <optgroup label="{{$value['category_name']}}">
                                    @foreach($value['jobs'] as $jobKey =>$jobValue)
                                    <option <?php echo ($profile['job_category_id'] == $jobValue['job_id']) ? 'selected="selected"' : '' ?> value="{{$jobValue['job_id']}}">{{$jobValue['job_name']}}</option>                                    
                                    @endforeach  
                                </optgroup>
                                @endforeach
                                @endif
                            </select>  
                        </div>
                    </div>
                    <div class="formRow">
                        <label>Annual Income Range</label>
                        <div class="radioRow"><input type="text" name="annual_income_from" value="{{$profile['annual_income_from']}}" ></div> 
                        <div class="radioRow"><input type="text" name="annual_income_to" value="{{$profile['annual_income_to']}}" ></div> 
                    </div>
                    <div class="formRow">
                        <label>Please indicate which smoking habits you would accept from your partner.</label>
                        <div class="radioRow">
                            <select style="width:300px" id="partner_smoking_habit" name="partner_smoking_habit">
                                <option value="never" <?php echo ($profile['partner_smoking_habit'] == 'never') ? 'selected="selected"' : '' ?>>Never</option>  
                                <option value="a_few_times_a_year" <?php echo ($profile['partner_smoking_habit'] == 'a_few_times_a_year') ? 'selected="selected"' : '' ?>>A few times a year</option>  
                                <option value="about_once_a_week" <?php echo ($profile['partner_smoking_habit'] == 'about_once_a_week') ? 'selected="selected"' : '' ?>>About once a week</option>  
                                <option value="a_few_times_a_week" <?php echo ($profile['partner_smoking_habit'] == 'a_few_times_a_week') ? 'selected="selected"' : '' ?>>A few times a week</option>  
                                <option value="every_day" <?php echo ($profile['partner_smoking_habit'] == 'every_day') ? 'selected="selected"' : '' ?>>Every day</option>  
                            </select>
                        </div> 

                    </div>
                    <div class="formRow">
                        <label>Please indicate which drinking habits you would accept from your partner.</label>
                        <div class="radioRow">
                            <select style="width:300px" id="partner_drinking_habit" name="partner_drinking_habit">
                                <option value="never" <?php echo ($profile['partner_drinking_habit'] == 'never') ? 'selected="selected"' : '' ?>>Never</option>  
                                <option value="several_times_a_year" <?php echo ($profile['partner_drinking_habit'] == 'several_times_a_year') ? 'selected="selected"' : '' ?>>Several times a year</option>  
                                <option value="about_once_a_week" <?php echo ($profile['partner_drinking_habit'] == 'about_once_a_week') ? 'selected="selected"' : '' ?>>About once a week</option>  
                                <option value="a_few_times_a_week" <?php echo ($profile['partner_drinking_habit'] == 'a_few_times_a_week') ? 'selected="selected"' : '' ?>>A few times a week</option>  
                                <option value="every_day" <?php echo ($profile['partner_drinking_habit'] == 'every_day') ? 'selected="selected"' : '' ?>>Every day</option>  
                            </select>
                        </div> 

                    </div>
                    <div class="formRow">
                        <label>How many children up to the age of 18 currently live in your household?</label>
                        <div class="radioRow"><input type="radio" name="no_of_children_lived_with" <?php echo ($profile['no_of_children_lived_with'] == 0) ? 'checked="checked"' : '' ?> value="0"><label>No children</label></div> 
                        <div class="radioRow"><input type="radio" name="no_of_children_lived_with" <?php echo ($profile['no_of_children_lived_with'] == 1) ? 'checked="checked"' : '' ?> value="1"><label>One child</label></div> 
                        <div class="radioRow"><input type="radio" name="no_of_children_lived_with" <?php echo ($profile['no_of_children_lived_with'] == 2) ? 'checked="checked"' : '' ?> value="2"><label>Two children</label></div> 
                        <div class="radioRow"><input type="radio" name="no_of_children_lived_with" <?php echo ($profile['no_of_children_lived_with'] == 3) ? 'checked="checked"' : '' ?> value="3"><label>Three or more children</label></div> 
                    </div>
                    <div class="formRow">
                        <label>Could you imagine having children or adopting with your partner and raising a family?</label>
                        <div class="radioRow">
                            <select style="width:300px" id="adopting_children" name="adopting_children">
                                <option value="yes">Yes</option>  
                                <option value="may_be">Maybe</option>  
                                <option value="no">No</option>  
                            </select>
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Would you accept a partner who has children under the age of 18 in her household?</label>
                        <div class="radioRow">
                            <input type="radio" name="accept_children_under_18" <?php echo ($profile['accept_children_under_18'] == 'yes') ? 'checked="checked"' : '' ?> value="yes"><label>Yes</label>
                            <input type="radio" name="accept_children_under_18" <?php echo ($profile['accept_children_under_18'] == 'no') ? 'checked="checked"' : '' ?> value="no"><label>No</label>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    
    $(document).ready(function () {
        addElements();
        $(function () {
            @if(count($data['traits'])>0)
                @foreach($data['traits'] as $key => $value)
                    $("#{{$value['category']}}, #{{$value['category']}}_sel").sortable({
                        connectWith: ".lists{{$value['category']}}",
                        cursor: "move"
                    }).disableSelection();
                @endforeach
            @endif
        });

        
    });

    function addElements() {
<<<<<<< HEAD
       
=======
        @if(count($data['traits'])>0)
            @foreach($data['traits'] as $key => $value)
                $("#{{$value['category']}}").empty().append('{!!$traits[$value['category']]!!}');
            @endforeach
        @endif
        
    }
    
    function getTraits(){
        var traits;
        $('.traits-selected .traits-box').each(function(){
            var id = $(this).data('id');
            var category = $(this).data('category');
            traits[category] = id;
        });
        console.log(JSON.stringify(traits));
>>>>>>> e07ccbf3b5ea8eb363b0c026e076d7b724f342aa
    }
    
    $('select').select2({
        minimumResultsForSearch: -1
    });
    $('#ethnic_origin').select2({
    });
    $('#smoking_habits').select2({
    });
    
    
    var availableTags = $.parseJSON('<?php echo addslashes(json_encode($data['mottos']));?>');
    $( "#motto_id" ).autocomplete({
      source: availableTags
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
    
//    $('.accordion-content').hide();
</script>
@endsection
