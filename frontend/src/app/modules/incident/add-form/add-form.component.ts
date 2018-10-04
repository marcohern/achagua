import { Component, OnInit, OnChanges } from '@angular/core';
import { GeocodeService } from '../geocode.service'
import { Race } from '../race';
import { LocationComponents } from '../location-components';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  olat: number = 3.441816;
  olng: number = -76.516484;
  lat:number;
  lng:number;

  races:Race[] = [
    {id:'N', name:'Afrocolombiano(a)'},
    {id:'I', name:'Indígena'},
    {id:'M', name:'Mestizo(a)'},
    {id:'B', name:'Blanco(a)'},
  ];

  incidentForm:FormGroup = new FormGroup({
    lat: new FormControl('',[Validators.required],[]),
    lng: new FormControl('',[Validators.required],[]),
    homeLocation: new FormGroup({
      country: new FormControl('',[Validators.required],[]),
      state:   new FormControl('',[Validators.required],[]),
      city:    new FormControl('',[Validators.required],[]),
      area:    new FormControl('',[],[]),
      zip:     new FormControl('',[],[])
    }),
    /*
    incidentLocation: new FormGroup({
      country: new FormControl('',[Validators.required],[]),
      state:   new FormControl('',[Validators.required],[]),
      city:    new FormControl('',[Validators.required],[]),
      area:    new FormControl('',[],[]),
      zip:     new FormControl('',[],[])
    }),*/
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
    }),

    gvt        : new FormControl('',[],[]),
    date_type  : new FormControl('',[],[]),
    date_year  : new FormControl('',[],[]),
    date_month : new FormControl('',[],[]),
    date_single: new FormControl('',[],[]),
    date_range : new FormControl('',[],[]),
    
    place: new FormControl('',[],[]),
    duration: new FormControl('',[],[]),
    weapons: new FormControl('',[],[]),
    what_weapons: new FormControl('',[],[]),
    sex_violence: new FormControl('',[],[]),
    who_was_there: new FormControl('',[],[]),
    how_many: new FormControl('',[],[]),
    afiliations: new FormControl('',[],[]),
    circumstances: new FormControl('',[],[]),
    consequences: new FormControl('',[],[]),
    repercussions: new FormControl('',[],[]),
    attention: new FormControl('',[],[]),
    what_attention: new FormControl('',[],[]),
    threatened: new FormControl('',[],[]),
    what_threats: new FormControl('',[],[]),
    when_how_threats: new FormControl('',[],[]),
    reported: new FormControl('',[],[]),
    after_reported: new FormControl('',[],[]),
    police_arrived: new FormControl('',[],[]),
    police_reactions: new FormControl('',[],[]),
    police_assisted: new FormControl('',[],[]),
    
    who_perpetrators: new FormControl('',[],[]),
    perp_motives: new FormControl('',[],[]),
    why_perp_motives: new FormControl('',[],[]),
    perps_said_did: new FormControl('',[],[]),
    perps_took_orders: new FormControl('',[],[]),
    perps_gave_orders: new FormControl('',[],[]),
  });

  date_type:string = '';
  weapons:boolean;
  attention:boolean;
  threatened:boolean;
  reported:boolean;
  police_arrived:boolean;

  constructor(private gs:GeocodeService, private fb:FormBuilder) { }

  ngOnInit() {
    //this.incidentForm.race.value = this.races[0];
    this.incidentForm.get('lat').setValue(this.olat);
    this.incidentForm.get('lng').setValue(this.olng);
    this.lat = this.olat;
    this.lng = this.olng;
  }

  onClickMap($event) {
    this.lat = $event.coords.lat;
    this.lng = $event.coords.lng;
    
    this.incidentForm.get('lat').setValue($event.coords.lat);
    this.incidentForm.get('lng').setValue($event.coords.lng);
    this.gs.getReverse(this.lat, this.lng).subscribe($info => this.setLocation($info));
  }

  private setLocation($info) {
    var acs = $info.results[0].address_components;
    var grp = this.incidentForm.get('homeLocation');
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
}
