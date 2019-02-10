import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

import { State } from '../state';
import { City } from '../city';

import { StateService } from '../state.service';
import { ViolenceType } from '../violence-type';
import { violenceTypes } from '../violence-types';

@Component({
  selector: 'app-add-form-simple-info',
  templateUrl: './add-form-simple-info.component.html',
  styleUrls: ['./add-form-simple-info.component.css']
})
export class AddFormSimpleInfoComponent implements OnInit {

  date_type:string = '';
  years:number[] = [];

  selectStates:State[];
  selectCities:City[];
  types:ViolenceType[] = violenceTypes;
  vbgError:string;

  @Input()
  submitDisabled:boolean = false;
  

  simpleForm:FormGroup;

  constructor(private fb:FormBuilder, private ss:StateService) { 
    
  }

  @Output()
  onSaving = new EventEmitter();

  onDeptoChanged() {
    var stateId = this.simpleForm.get('state');
    if (stateId.value=='') {
      this.selectCities = [];
      return;
    }
    var state = this.ss.getState(stateId.value);
    this.selectCities = state.cities;
    console.log("onDeptoChanged",stateId.value);
  }

  ngOnInit() {

    this.simpleForm = this.fb.group({
      vbg: this.fb.array([false,false,false,false,false,false,false,false,false,false]),
      year: this.fb.control('',[Validators.required]),
      
      state: this.fb.control('', [Validators.required]),
      city: this.fb.control('',[Validators.required]),
      justice: this.fb.control(null,[Validators.required]),
    });

    var now = new Date();
    var current = now.getFullYear();
    var start = current;
    for (let i=0;i>=-100;i--) {
      this.years.push(start+i);
    }
    this.simpleForm.get('year').setValue(current);

    this.selectStates = this.ss.getStates();
    this.selectCities = [];
  }

  send($event) {
    this.vbgError = '';
    var value = this.simpleForm.value;
    
    var vbg:string = '';
    for (let i in value.vbg) {
      var chk = value.vbg[i];
      if (chk) {
        if (parseInt(i) > 0) vbg += ",";
        vbg += this.types[i].code;
      }
    }

    if (vbg == '') {
      this.vbgError = 'Debe seleccionar al menos un tipo de Violencia';
      return;
    }
    var trueValue = {
      vbg: vbg,
      event_date: value.event_date,
      //lat: value.lat,
      //lng: value.lng,
      //country: value.country,
      city: value.city,
      state: value.state,
      justice: value.justice
    };
    console.log(value,trueValue);
    

    this.onSaving.emit({
      value: trueValue
    });
    this.simpleForm.setValue({
      vbg: [false,false,false,false,false,false,false,false,false,false],
      year: '',
      //country: this.fb.control(''),
      state: '',
      city: '',
      justice: '',
    });
    
  }

}
