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
    <div class="box pad edit-profile">
        {{ Form::open(array('url' => '#', 'method' => 'post', 'id' => 'editProfile')) }}
            <div class="thick-text">Edit profile</div>
            <div class="accordion-group">
                <div class="accordion">
                    <div class="accordion-title">Personal Details</div>
                    <div class="accordion-content" style="display: none;">
                        <label>Name</label>
                        <div class="inputField">
                            <input type="text" name="name" value="{{$data['userprofiles']->name or ''}}" required>
                        </div>
                        <br>
                        <label>DOB</label>
                        <div class="inputField">
                            <input required type="text" name="age" id="age" value="{{$data['userprofiles']->birthday or ''}}" readonly="" class="picker__input" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="age_root"><div class="picker" id="age_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><select class="picker__select--year" disabled="" aria-controls="age_table" title="Select a year"><option value="1917">1917</option><option value="1918">1918</option><option value="1919">1919</option><option value="1920">1920</option><option value="1921">1921</option><option value="1922">1922</option><option value="1923">1923</option><option value="1924">1924</option><option value="1925">1925</option><option value="1926">1926</option><option value="1927">1927</option><option value="1928">1928</option><option value="1929">1929</option><option value="1930">1930</option><option value="1931">1931</option><option value="1932">1932</option><option value="1933">1933</option><option value="1934">1934</option><option value="1935">1935</option><option value="1936">1936</option><option value="1937">1937</option><option value="1938">1938</option><option value="1939">1939</option><option value="1940">1940</option><option value="1941">1941</option><option value="1942">1942</option><option value="1943">1943</option><option value="1944">1944</option><option value="1945">1945</option><option value="1946">1946</option><option value="1947">1947</option><option value="1948">1948</option><option value="1949">1949</option><option value="1950">1950</option><option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997" selected="">1997</option></select><select class="picker__select--month" disabled="" aria-controls="age_table" title="Select a month"><option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3">April</option><option value="4">May</option><option value="5">June</option><option value="6" selected="">July</option><option value="7" disabled="">August</option><option value="8" disabled="">September</option><option value="9" disabled="">October</option><option value="10" disabled="">November</option><option value="11" disabled="">December</option></select><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="age_table" title="Previous month"> </div><div class="picker__nav--next picker__nav--disabled" data-nav="1" role="button" aria-controls="age_table" title="Next month"> </div></div><table class="picker__table" id="age_table" role="grid" aria-controls="age" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="867522600000" role="gridcell" aria-label="29 June, 1997">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="867609000000" role="gridcell" aria-label="30 June, 1997">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="867695400000" role="gridcell" aria-label="1 July, 1997">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="867781800000" role="gridcell" aria-label="2 July, 1997">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="867868200000" role="gridcell" aria-label="3 July, 1997">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="867954600000" role="gridcell" aria-label="4 July, 1997">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868041000000" role="gridcell" aria-label="5 July, 1997">5</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868127400000" role="gridcell" aria-label="6 July, 1997">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868213800000" role="gridcell" aria-label="7 July, 1997">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868300200000" role="gridcell" aria-label="8 July, 1997">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868386600000" role="gridcell" aria-label="9 July, 1997">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868473000000" role="gridcell" aria-label="10 July, 1997">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="868559400000" role="gridcell" aria-label="11 July, 1997">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--highlighted" data-pick="868645800000" role="gridcell" aria-label="12 July, 1997" aria-activedescendant="true">12</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="868732200000" role="gridcell" aria-label="13 July, 1997" aria-disabled="true">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="868818600000" role="gridcell" aria-label="14 July, 1997" aria-disabled="true">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="868905000000" role="gridcell" aria-label="15 July, 1997" aria-disabled="true">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="868991400000" role="gridcell" aria-label="16 July, 1997" aria-disabled="true">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869077800000" role="gridcell" aria-label="17 July, 1997" aria-disabled="true">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869164200000" role="gridcell" aria-label="18 July, 1997" aria-disabled="true">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869250600000" role="gridcell" aria-label="19 July, 1997" aria-disabled="true">19</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869337000000" role="gridcell" aria-label="20 July, 1997" aria-disabled="true">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869423400000" role="gridcell" aria-label="21 July, 1997" aria-disabled="true">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869509800000" role="gridcell" aria-label="22 July, 1997" aria-disabled="true">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869596200000" role="gridcell" aria-label="23 July, 1997" aria-disabled="true">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869682600000" role="gridcell" aria-label="24 July, 1997" aria-disabled="true">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869769000000" role="gridcell" aria-label="25 July, 1997" aria-disabled="true">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869855400000" role="gridcell" aria-label="26 July, 1997" aria-disabled="true">26</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="869941800000" role="gridcell" aria-label="27 July, 1997" aria-disabled="true">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="870028200000" role="gridcell" aria-label="28 July, 1997" aria-disabled="true">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="870114600000" role="gridcell" aria-label="29 July, 1997" aria-disabled="true">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="870201000000" role="gridcell" aria-label="30 July, 1997" aria-disabled="true">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--disabled" data-pick="870287400000" role="gridcell" aria-label="31 July, 1997" aria-disabled="true">31</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870373800000" role="gridcell" aria-label="1 August, 1997" aria-disabled="true">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870460200000" role="gridcell" aria-label="2 August, 1997" aria-disabled="true">2</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870546600000" role="gridcell" aria-label="3 August, 1997" aria-disabled="true">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870633000000" role="gridcell" aria-label="4 August, 1997" aria-disabled="true">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870719400000" role="gridcell" aria-label="5 August, 1997" aria-disabled="true">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870805800000" role="gridcell" aria-label="6 August, 1997" aria-disabled="true">6</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870892200000" role="gridcell" aria-label="7 August, 1997" aria-disabled="true">7</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="870978600000" role="gridcell" aria-label="8 August, 1997" aria-disabled="true">8</div></td><td role="presentation"><div class="picker__day picker__day--outfocus picker__day--disabled" data-pick="871065000000" role="gridcell" aria-label="9 August, 1997" aria-disabled="true">9</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1499797800000" disabled="" aria-controls="age">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="age">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="age">Close</button></div></div></div></div></div></div>
                        </div>
                        <br>
                        <label>Height(cm)</label>
                        <div class="inputField">
                            <input type="number" name="height" value="{{$data['userprofiles']->about}}">
                        </div>
                        <br>
                        <label>About Me</label>
                        <div class="inputField">
                            <textarea required name="about-me">{{$data['userprofiles']->about}}</textarea>
                        </div>
                        <br>
                        <label>Edit Motto</label>
                        <div class="inputField">
                            <input required type="text" name="org_motto" id="org_motto" value="">
                        </div>
                        <br>
                        <label>Choose Motto</label>
                        <div class="inputField">
                            {!! Form::select('motto', $data['mottos'], $data['userprofiles']->motto, ['class' => 'dropdown', 'required']) !!}
                        </div>
                        <br>
                        <label>Relationship History</label>
                        <div class="inputField">
                            {!! Form::select('relationhist', $data['relationhistory'], $data['userprofiles']->relationhist, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Education</label>
                        <div class="inputField">
                            {!! Form::select('education', $data['education'], $data['userprofiles']->education, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Profession</label>
                        <div class="inputField">
                            {!! Form::select('profession', $data['profession'], $data['userprofiles']->profession, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Body Type</label>
                        <div class="inputField">
                            {!! Form::select('bodytype', $data['bodytype'], $data['userprofiles']->bodytype, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Zodiac</label>
                        <div class="inputField">
                            {!! Form::select('zodiac', $data['zodiac'], $data['userprofiles']->zodiac, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Disability</label>
                        <div class="inputField">
                            {!! Form::select('disability', ['y'=>'Yes','n'=>'No'], $data['userprofiles']->disability, ['required', 'class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Fluency</label>
                        <div class="inputField">
                            {!! Form::select('fluency', $data['languages'], $data['userprofiles']->fluency, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Annual Income(AUD)</label>
                        <div class="inputField">
                            <input type="number" value="" name="annual_in" id="annual_in">
                        </div>
                    </div>
                </div>
                <div class="accordion">
                    <div class="accordion-title">Personal Appearance</div>
                    <div class="accordion-content" style="display: none;">
                        <label>Hair Color</label>
                        <div class="inputField">
                            {!! Form::select('haircolor', $data['color'], $data['userprofiles']->haircolor, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Hair Appearance</label>
                        <div class="inputField">
                            {!! Form::select('hairapp', $data['hairapp'], $data['userprofiles']->hairapp, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Eye Color</label>
                        <div class="inputField">
                            {!! Form::select('eyecolor', $data['color'], $data['userprofiles']->eyecolor, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Eye Wear</label>
                        <div class="inputField">
                            {!! Form::select('eyewear', $data['eyewear'], $data['userprofiles']->eyewear, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Weight(kg)</label>
                        <div class="inputField">
                            <input type="number" name="weight" value="">
                        </div>
                        <br>
                        <label>Ethnicity</label>
                        <div class="inputField">
                            {!! Form::select('ethinicity', ['1'=>'Yes','0'=>'No'], $data['userprofiles']->ethinicity, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Tattoo</label>
                        <div class="inputField">
                            {!! Form::select('tatoo', ['1'=>'Yes','0'=>'No'], $data['userprofiles']->tatoo, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Overall Appearance</label>
                        <div class="inputField">
                            {!! Form::select('appearance', $data['appearance'], $data['userprofiles']->appearance, ['class' => 'dropdown']) !!}
                        </div>
                    </div>
                </div>
                <div class="accordion">
                    <div class="accordion-title">Social &amp; Lifestyle</div>
                    <div class="accordion-content" style="display: none;">
                        <label>Smoke</label>
                        <div class="inputField">
                            {!! Form::select('smoke', $data['smoketype'], $data['userprofiles']->smoke, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Drink</label>
                        <div class="inputField">
                            {!! Form::select('drink', $data['drinktype'], $data['userprofiles']->drink, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Pet Lover</label>
                        <div class="inputField">
                            {!! Form::select('pets', $data['pets'], $data['userprofiles']->pets, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Marital Status</label>
                        <div class="inputField">
                            {!! Form::select('marital', $data['marital'], $data['userprofiles']->marital, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Countries Visited</label>
                        <div class="inputField">
                            {!! Form::select('countries_visit', $data['countries'], $data['userprofiles']->countries_visit, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Children</label>
                        <div class="inputField">
                            {!! Form::select('children', [1,2,3,4,5,6,7,8,9], $data['userprofiles']->children, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Relationship Looking For</label>
                        <div class="inputField">
                            {!! Form::select('relationlooking', $data['relationfor'], $data['userprofiles']->relationlooking, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Their Ethnicity</label>
                        <div class="inputField">
                            {!! Form::select('relethinicity', ['1'=>'Yes','0'=>'No'], $data['userprofiles']->relethinicity, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Their Tattoo</label>
                        <div class="inputField">
                            {!! Form::select('reltatoo', ['1'=>'Yes','0'=>'No'], $data['userprofiles']->reltatoo, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Their Appearance</label>
                        <div class="inputField">
                            {!! Form::select('relappearance', $data['appearance'], $data['userprofiles']->relappearance, ['class' => 'dropdown']) !!}
                        </div>
                        <br>
                        <label>Their marital status</label>
                        <div class="inputField">
                            {!! Form::select('relmarital', $data['marital'], $data['userprofiles']->relmarital, ['class' => 'dropdown']) !!}
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
//    $('select').select2({
//        minimumResultsForSearch: -1
//    });

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
                    setTimeout(function(){ $("#result").hide('slow'); }, 6000);
                }
            });
        }
    }
</script>
@endsection