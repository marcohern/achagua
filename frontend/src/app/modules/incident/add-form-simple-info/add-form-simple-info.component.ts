import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';

import { Country } from '../country';
import { State } from '../state';
import { City } from '../city';

import { countries } from '../countries';
import { states } from '../states';
import { cities } from '../cities';

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
  

  simpleForm:FormGroup;

  constructor(private fb:FormBuilder) { 
    
  }

  @Output()
  onSaving = new EventEmitter();

  getState(stateId:number) {
    for(let state of states) {
      if (state.id == stateId) {
        return state;
      }
    }
    return null;
  }

  onDeptoChanged() {
    var stateId = this.simpleForm.get('state');
    if (stateId.value=='') {
      this.selectCities = [];
      return;
    }
    var state = this.getState(stateId.value);
    this.selectCities = state.cities;
    console.log("onDeptoChanged",stateId.value);
  }

  ngOnInit() {

    this.simpleForm = this.fb.group({
      vbg: this.fb.control('',[Validators.required]),
      year: this.fb.control('',[Validators.required]),
      //country: this.fb.control(''),
      state: this.fb.control('', [Validators.required]),
      city: this.fb.control('',[Validators.required]),
      justice: this.fb.control(null,[Validators.required]),
    });

    var now = new Date();
    var current = now.getFullYear();
    var start = current - 30;
    for (let i=0;i<=131;i++) {
      this.years.push(start+i);
    }
    this.simpleForm.get('year').setValue(current);

    for (let city of cities) {
      if (city.state == null) {
        var state = this.getState(city.state_id);
        city.state = state;
        if (state.cities==null) state.cities = [];
        state.cities.push(city);
      }
    }

    this.selectStates = states;
    this.selectCities = [];
  }

  send($event) {
    this.onSaving.emit({
      value: this.simpleForm.value
    });
  }

}
