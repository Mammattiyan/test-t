@extends('users.profileskeleton')
@section('title')
	itweetup :: Profile
@endsection
@section('centerpane')


	<div class="flex-item updates-block">

			@if ($errors->any())
				<div class="box error_list">
						<ul>
						 @foreach ($errors->all() as $error)
							<li>{{ $error }}</li>      
						@endforeach
						</ul>
				</div>
			 @endif
				<div class="box">
					<div class="pad">
						<div class="search-field">
							<input type="text" name="search-stuff" placeholder="Search">
							<a href="#"></a>
						</div>
					</div>
				</div>
				<div class="box pad edit-profile">
					<form action="{{ url('/update-profile') }}" method="POST" >
		
					<div class="thick-text">Edit profile</div>
					<div class="accordion-group">
						<div class="accordion">
							<div class="accordion-title">Personal Details</div>
							<div class="accordion-content">
								<label>Name</label>
								<input type="text" name="name" value="{{ $data['user']['name']}}">
								<br>
								<label>DOB</label>
								<input type="text" name="age" id="age" value="{{ $data['user']['birthday']}}">
								<br>
								<label>Height(cm)</label>
								<input type="number" name="height" value="{{ $data['userprofiles']['height'] }}">
								<br>
								<label>About Me</label>
								<textarea name="about-me">{{ $data['userprofiles']['about'] }}</textarea>
								<br>
								<label>Edit Motto</label>
								<input type="text" name="org_motto" id="org_motto" value ="{{ $data['userprofiles']['motto'] }}">
								<br>
								<label>Choose Motto</label>
								<div class="dropdown motto">
									<input type="hidden" value="{{ $data['userprofiles']['motto'] }}" name="motto" id="motto"/>
									<div class="selected-option">
										@if($data['userprofiles']['motto'] != '') 
											{{$data['userprofiles']['motto']}}
										@else
											Select
										@endif
										
										</div>
									<ul class="dropdown-options">
										@if($data['mottos']->count())
											@foreach($data['mottos'] as $motto)
												<li value="{!! $motto->motto !!}">{!! $motto->motto !!}</li>
											@endforeach
										@endif						
									</ul>	
								</div>
								<br>
								<label>Relationship History</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['relationhist'] }}" name="rel_hist" id="rel_hist"/>
									<div class="selected-option">
										@if($data['mapped'][0]->rel_hist != '') 
											{{$data['mapped'][0]->rel_hist}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['relationhistory']->count())
											@foreach($data['relationhistory'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->rel_hist !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Education</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['education'] }}" name="education" id="education"/>
									<div class="selected-option">
										@if($data['mapped'][0]->education != '') 
											{{$data['mapped'][0]->education}}
										@else
											Select
										@endif
										</div>
									<ul class="dropdown-options">
										@if($data['education']->count())
											@foreach($data['education'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->education !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Profession</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['profession'] }}" name="profession" id="profession"/>
									<div class="selected-option">
									@if($data['mapped'][0]->profession != '') 
											{{$data['mapped'][0]->profession}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['profession']->count())
											@foreach($data['profession'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->profession !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Body Type</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['bodytype'] }}" name="body_type" id="body_type"/>
									<div class="selected-option">
										@if($data['mapped'][0]->body_type != '') 
											{{$data['mapped'][0]->body_type}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['bodytype']->count())
											@foreach($data['bodytype'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->body_type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Zodiac</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['zodiac'] }}" name="zodiac" id="zodiac"/>
									<div class="selected-option">
									@if($data['mapped'][0]->zodiac != '') 
											{{$data['mapped'][0]->zodiac}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['zodiac']->count())
											@foreach($data['zodiac'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->zodiac !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Disability</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['disability'] }}" name="disability" id="disability"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										<li value="y">Yes</li>
										<li value="n">No</li>
									</ul>
								</div>
								<br>
								<label>Fluency</label>
								<input type="hidden" value="{{ $data['userprofiles']['fluency'] }}" name="languages" id="languages"/>
								<input type="text" name="language-list" id="language-list" data-modal="c_fluency"/>
								<div class="modal-glass hide">
									<div class="modal">
										<div class="modal-heading"></div>
										<div class="modal-body"></div>
										<div class="modal-close"></div>
									</div>
								</div>
								<div class="hide" data-modal-contents-wrap>
									<div data-modal-content="c_fluency">
										<div data-modal-heading>Select the languages</div>
										<div data-modal-body>
											
											<button type="submit" class="button" id="select-c" onClick="selectValues('language');">Submit</button>
									<div class="checkbox-wrap">
										<div class="flex-box fd-col fd-md-row">
											<div class="flex-item">
												
										@if($data['languages']->count())
											$count = $data['languages']->count();
											@for ($i = 0; $i < $count; $i++)
												@if($i == ceil($count/2))
													</div>
													<div class="flex-item">
												@endif
												
												<input type="checkbox" class="language" name="languages[]" id="languages-{{ $data['languages'][$i]->name }}" value="{{ $data['languages'][$i]->id }}"
												@if(in_array( $data['languages'][$i]->id, array($data['userprofiles']['fluency'])))
													checked
												@endif
												>
												<label for="languages-{{ $data['pets'][$i]->name }}">{{ $data['languages'][$i]->name }}</label>
												<br>
												
												
											@endfor									
										@endif	
										
											</div>
										</div>
									</div>
										</div>
									</div>
								</div>
								<br>
								<label>Annual Income(AUD)</label>
								<input type="number" value="{{ $data['userprofiles']['height'] }}" name="annual_in" id="annual_in"/>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-title">Personal Appearance</div>
							<div class="accordion-content">
								<label>Hair Color</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['haircolor'] }}" name="hair_color" id="hair_color"/>
									<div class="selected-option">
										@if($data['mapped'][0]->hcolor != '') 
											{{$data['mapped'][0]->hcolor}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['color']->count())
											@foreach($data['color'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->name !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Hair Appearance</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['hairapp'] }}" name="hair_app" id="hair_app"/>
									<div class="selected-option">
										@if($data['mapped'][0]->htype != '') 
											{{$data['mapped'][0]->htype}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['hairapp']->count())
											@foreach($data['hairapp'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Eye Color</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['eyecolor'] }}" name="eye_color" id="eye_color"/>
									<div class="selected-option">
										@if($data['mapped'][0]->ecolor != '') 
											{{$data['mapped'][0]->ecolor}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['color']->count())
											@foreach($data['color'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->name !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Eye Wear</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['eyewear'] }}" name="eye_wear" id="eye_wear"/>
									<div class="selected-option">
										@if($data['mapped'][0]->etype != '') 
											{{$data['mapped'][0]->etype}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['eyewear']->count())
											@foreach($data['eyewear'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Weight(kg)</label>
								<input type="number" name="weight" value="{{ $data['userprofiles']['weight'] }}"/>
								<br>
								<label>Ethnicity</label>
								<div class="dropdown">
									<input type="hidden" value="" name="ethinic" id="ethinic"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										@if($data['eyewear']->count())
											@foreach($data['eyewear'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Tattoo</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['tatoo'] }}" name="tattoo" id="tattoo"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										<li value="y">Yes</li>
										<li value="n">No</li>
									</ul>
									</ul>
								</div>
								<br>
								<label>Overall Appearance</label>
								<div class="dropdown">
								<input type="hidden" value="{{ $data['userprofiles']['appearance'] }}" name="over_app" id="over_app"/>
									<div class="selected-option">
										@if($data['mapped'][0]->atype != '') 
											{{$data['mapped'][0]->atype}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['appearance']->count())
											@foreach($data['appearance'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-title">Social &amp; Lifestyle</div>
							<div class="accordion-content">
								<label>Smoke</label>
								<div class="dropdown">
								<input type="hidden" value="{{ $data['userprofiles']['smoke'] }}" name="smoke" id="smoke"/>
									<div class="selected-option">
										@if($data['mapped'][0]->stype != '') 
											{{$data['mapped'][0]->stype}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['smoketype']->count())
											@foreach($data['smoketype'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Drink</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['drink'] }}" name="drink" id="drink"/>
									<div class="selected-option">
										@if($data['mapped'][0]->dtype != '') 
											{{$data['mapped'][0]->dtype}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['drinktype']->count())
											@foreach($data['drinktype'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<br>
								<label>Pet Lover</label>
								<div class="checkbox-wrap">
									<input type="hidden" value="{{ $data['userprofiles']['pets'] }}" name="pets" id="pets"/>
									<div class="flex-box fd-col fd-md-row">
										<div class="flex-item">
										@if($data['pets']->count())
											<?php $count = $data['pets']->count(); ?>
											@for ($i = 0; $i < $count; $i++)
												@if($i == ceil($count/2))
													</div>
													<div class="flex-item">
												@endif
												
												<input type="checkbox" name="pets[]" id="pet-{{ $data['pets'][$i]->name }}" value="{{ $data['pets'][$i]->id }}"
												@if(in_array( $data['pets'][$i]->id, array($data['user']['pets'])))
													checked
												@endif
												>
												<label for="pet-{{ $data['pets'][$i]->name }}">{{ $data['pets'][$i]->name }}</label>
												<br>
												
												
											@endfor									
										@endif	
										</div>
									</div>
								</div>
								<br>
								<label>Marital Status</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['marital'] }}" name="marital" id="marital"/>
									<div class="selected-option">
										@if($data['mapped'][0]->status != '') 
											{{$data['mapped'][0]->status}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['marital']->count())
											@foreach($data['marital'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->status !!}</li>
											@endforeach
										@endif
									</ul>
								</div>
								<br>
								<label>Countries Visited</label>
								<input type="hidden" value="{{ $data['userprofiles']['countries_visit'] }}" name="countries" id="countries"/>
								<input type="text" name="countrie-list" id="countrie-list" data-modal="c_visited">
								<div class="modal-glass hide">
								<div class="modal">
									<div class="modal-heading"></div>
									<div class="modal-body"></div>
									<div class="modal-close"></div>
								</div>
							</div>
							<div class="hide" data-modal-contents-wrap>
								<div data-modal-content="c_visited">
									<div data-modal-heading>Select the countries</div>
									<div data-modal-body>
										<button type="submit" class="submit" value="ok" id="select-c" onClick="selectValues('countrie');">Submit</button>
										<div class="checkbox-wrap">
											<div class="flex-box fd-col fd-md-row">
												<div class="flex-item">
												@if($data['countries']->count())
													$count = $data['countries']->count();
													$iter = ceil($count/3);
													@for ($i = 0; $i < $count; $i++)
														@if($i>=$iter && $i%$iter == 0)
															</div>
															<div class="flex-item">
														@endif
														
														<input type="checkbox" name="countries[]" id="pet-{{ $data['countries'][$i]->name }}" value="{{ $data['countries'][$i]->id }}"
														@if(in_array( $data['countries'][$i]->id, array($data['user']['countries'])))
															checked
														@endif
														>
														<label for="con-{{ $data['countries'][$i]->name }}">{{ $data['countries'][$i]->name }}</label>
														<br>
														
														
													@endfor									
												@endif	
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								<br>
								<label>Children</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['children'] }}" name="children" id="children"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										<li value="y">Yes</li>
										<li value="n">No</li>
									</ul>
								</div>
								<hr>
								<label>Relationship Looking For</label>
								<div class="dropdown">
									<input type="hidden" value="" name="rel_looking" id="rel_looking"/>
									<div class="selected-option">
										@if($data['mapped'][0]->lrel_hist != '') 
											{{$data['mapped'][0]->lrel_hist}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['relationfor']->count())
											@foreach($data['relationfor'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->rel_for !!}</li>
											@endforeach
										@endif
									</ul>
								</div>
								<br>
								<label>Their Ethnicity</label>
								<div class="dropdown">
									<input type="hidden" value="" name="rel_ethin" id="rel_ethin"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										@if($data['relationfor']->count())
											@foreach($data['relationfor'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->rel_for !!}</li>
											@endforeach
										@endif
									</ul>
								</div>
								<br>
								<label>Their Tattoo</label>
								<div class="dropdown">
									<input type="hidden" value="" name="rel_tattoo" id="rel_tattoo"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										<ul class="dropdown-options">
										<li value="y">Yes</li>
										<li value="n">No</li>
									</ul>
									</ul>
								</div>
								<br>
								<label>Their Appearance</label>
								<div class="dropdown">
									<input type="hidden" value="" name="rel_app" id="rel_app"/>
									<div class="selected-option">Select</div>
									<ul class="dropdown-options">
										@if($data['appearance']->count())
											@foreach($data['appearance'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->type !!}</li>
											@endforeach
										@endif	
									</ul>
								</div>
								<label>Their marital status</label>
								<div class="dropdown">
									<input type="hidden" value="{{ $data['userprofiles']['relmarital'] }}" name="rel_marital" id="rel_marital"/>
									<div class="selected-option">
										@if($data['mapped'][0]->lstatus != '') 
											{{$data['mapped'][0]->lstatus}}
										@else
											Select
										@endif
									</div>
									<ul class="dropdown-options">
										@if($data['marital']->count())
											@foreach($data['marital'] as $rel)
												<li value="{!! $rel->id !!}">{!! $rel->status !!}</li>
											@endforeach
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
						{{ csrf_field() }}
						<div class="flex-item text-right">
								<input type="submit" name="editpic" class="button" value="Submit">
							</div>
					</form>
				</div>
			</div>
@endsection

@section('rightpane')
<div class="flex-item">
				<div class="copyright">itweetup &copy; 2016</div>
			</div>
@endsection
