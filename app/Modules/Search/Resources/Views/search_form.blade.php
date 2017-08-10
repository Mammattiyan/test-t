{!! Form::open(array('url'=>'search/result','id'=>'search_form','method'=>'post')) !!} 
<div class="pad">
    <div class="search-field">
        <input type="text" name="name" placeholder="Search">
        <a href="#"></a>
    </div>


    <div class="accordion-group">
        <div class="accordion">
            <div class="accordion-title">Details Search</div>
            <div class="accordion-content" style="display: none;">
                
                <div class="formRow">
                    <label>Motto</label>
                    <div><input type="text" name="motto" id="motto_id" value="{{$profile['motto'] or ''}}" required></div> 
                </div>
                
            </div>
        </div>
    </div>
<br>
</div>
<br>
{!! Form::close() !!}