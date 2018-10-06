import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { GeocodeService } from '../geocode.service';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { Race } from '../race';

@Component({
  selector: 'incident-add-form-victim-info',
  templateUrl: './add-form-victim-info.component.html',
  styleUrls: ['./add-form-victim-info.component.css']
})
export class AddFormVictimInfoComponent implements OnInit {

  @Input()
  olat:number = 3.441816;

  @Input()
  olng:number = -76.516484;

  @Output()
  victimInfo = new EventEmitter();

  lat:number;
  lng:number;

  races:Race[] = [
    {id:'N', name:'Afrocolombiano(a)'},
    {id:'I', name:'Indígena'},
    {id:'M', name:'Mestizo(a)'},
    {id:'B', name:'Blanco(a)'},
  ];

  victimInfoForm:FormGroup = new FormGroup({
    lat: new FormControl('',[Validators.required],[]),
    lng: new FormControl('',[Validators.required],[]),
    homeLocation: new FormGroup({
      country: new FormControl('',[Validators.required],[]),
      state:   new FormControl('',[Validators.required],[]),
      city:    new FormControl('',[Validators.required],[]),
      area:    new FormControl('',[],[]),
      zip:     new FormControl('',[],[])
    }),
    race:     new FormControl('',[Validators.required],[]),
    gender:   new FormControl('',[Validators.required],[]),
    relation: new FormControl('',[Validators.required],[]),
    
    livingWith: new FormGroup({
      children: new FormControl('',[],[]),
      spouse  : new FormControl('',[],[]),
      father  : new FormControl('',[],[]),
      mother  : new FormControl('',[],[]),
      grandfather: new FormControl('',[],[]),
      grandmother: new FormControl('',[],[]),
      siblings   : new FormControl('',[],[]),
      other      : new FormControl('',[],[])
    })
  });

  constructor(private gs:GeocodeService, private fb:FormBuilder) { }


  ngOnInit() {
    this.victimInfoForm.get('lat').setValue(this.olat);
    this.victimInfoForm.get('lng').setValue(this.olng);
    this.lat = this.olat;
    this.lng = this.olng;
  }


  onClickMap($event) {
    this.lat = $event.coords.lat;
    this.lng = $event.coords.lng;
    
    this.victimInfoForm.get('lat').setValue($event.coords.lat);
    this.victimInfoForm.get('lng').setValue($event.coords.lng);
    this.gs.getReverse(this.lat, this.lng).subscribe($info => this.setLocation($info));
  }

  private setLocation($info) {
    var acs = $info.results[0].address_components;
    var grp = this.victimInfoForm.get('homeLocation');
    for (let ac of acs) {
      var idx = -1;
      idx = ac.types.indexOf('country');//Pais
      if (idx > -1) grp.get('country').setValue(ac.long_name);
      idx = ac.types.indexOf('administrative_area_level_1');//Depto
      if (idx > -1) grp.get('state').setValue(ac.long_name);
      //idx = ac.types.indexOf('administrative_area_level_2');//Depto
      //if (idx > -1) console.log("Area 2",ac.long_name);
      idx = ac.types.indexOf('locality');//Ciudad
      if (idx > -1) grp.get('city').setValue(ac.long_name);
      idx = ac.types.indexOf('administrative_area_level_2');//Ciudad
      if (idx > -1 && grp.get('city').value == '') grp.get('city').setValue(ac.long_name);
      idx = ac.types.indexOf('neighborhood');//Barrio
      if (idx > -1) grp.get('area').setValue(ac.long_name);
      idx = ac.types.indexOf('postal_code');//Codigo Postal
      if (idx > -1) grp.get('zip').setValue(ac.long_name);
    }
  }

  private next($event) {
    this.victimInfo.emit({victimInfo: this.victimInfoForm.value});
  }
}
