import { Component, OnInit, OnChanges } from '@angular/core';
import { GeocodeService } from '../geocode.service';
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

  

  incidentForm:FormGroup = new FormGroup({
    
    /*
    incidentLocation: new FormGroup({
      country: new FormControl('',[Validators.required],[]),
      state:   new FormControl('',[Validators.required],[]),
      city:    new FormControl('',[Validators.required],[]),
      area:    new FormControl('',[],[]),
      zip:     new FormControl('',[],[])
    }),*/
    

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
  }
}
