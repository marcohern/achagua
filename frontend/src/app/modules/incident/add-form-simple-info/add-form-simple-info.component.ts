import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';

import { Country } from '../country';
import { State } from '../state';
import { City } from '../city';

import { countries } from '../countries';
import { IncidentsService } from '../incidents.service';
import { StateService } from '../state.service';

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
      vbg: this.fb.control('',[Validators.required]),
      year: this.fb.control('',[Validators.required]),
      //country: this.fb.control(''),
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
    this.onSaving.emit({
      value: this.simpleForm.value
    });
    this.simpleForm.setValue({
      vbg: '',
      year: '',
      //country: this.fb.control(''),
      state: '',
      city: '',
      justice: '',
    });
    
  }

}
