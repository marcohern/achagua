import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-add-form-simple-info',
  templateUrl: './add-form-simple-info.component.html',
  styleUrls: ['./add-form-simple-info.component.css']
})
export class AddFormSimpleInfoComponent implements OnInit {

  date_type:string = '';
  years:number[] = [];

  simpleForm:FormGroup;

  constructor(private fb:FormBuilder) { 
    
  }

  onDeptoChanged() {
    var depto = this.simpleForm.get('state');
    console.log("onDeptoChanged",depto);
  }

  ngOnInit() {
    var now = new Date();
    for (let i=0;i<=101;i++) {
      this.years.push(now.getFullYear() + i - 1);
    }

    this.simpleForm = this.fb.group({
      vbg: this.fb.control(''),
      year: this.fb.control(''),

    });
  }

}
