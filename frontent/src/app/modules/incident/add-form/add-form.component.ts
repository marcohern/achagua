import { Component, OnInit, OnChanges } from '@angular/core';
import { GeocodeService } from '../geocode.service'
import { Race } from '../race';
import { LocationComponents } from '../location-components';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  olat: number = 3.441816;
  olng: number = -76.516484;
  lat: number;
  lng: number;
  loc:LocationComponents = { country:'', state:'', city:'', area:'', zip:'' };

  races:Race[] = [
    {id:'N', name:'Afrocolombiano(a)'},
    {id:'I', name:'Indígena'},
    {id:'M', name:'Mestizo(a)'},
    {id:'B', name:'Blanco(a)'},
  ];

  race:Race = null;
  gender:string = 'F';
  relation:string = '';

  lw_children:boolean = false;
  lw_spouse:boolean = false;
  lw_father:boolean = false;
  lw_mother:boolean = false;
  lw_grandfather:boolean = false;
  lw_grandmother:boolean = false;
  lw_siblings:boolean = false;
  lw_other:boolean = false;

  gvt:string = 'VS';
  date_type:string = '';
  date_year:string = '';
  date_month:string = '';
  date_start:string = '';
  date_end:string = '';

  constructor(private gs:GeocodeService) { }

  ngOnInit() {
    this.race = this.races[0];
    this.lat = this.olat;
    this.lng = this.olng;
    this.loc = { country:'', state:'', city:'', area:'', zip:'' };
    this.gs.getReverse(this.lat, this.lng).subscribe($info => this.setLocation($info));
  }

  onClickMap($event) {
    //console.log("map",$event);
    this.lat = $event.coords.lat;
    this.lng = $event.coords.lng;
    this.loc = { country:'', state:'', city:'', area:'', zip:'' };
    this.gs.getReverse(this.lat, this.lng).subscribe($info => this.setLocation($info));
  }

  private setLocation($info) {
    var acs = $info.results[0].address_components;
    for (let ac of acs) {
      var idx = -1;
      idx = ac.types.indexOf('country');//Pais
      if (idx > -1) this.loc.country = ac.long_name;
      idx = ac.types.indexOf('administrative_area_level_1');//Depto
      if (idx > -1) this.loc.state = ac.long_name;
      //idx = ac.types.indexOf('administrative_area_level_2');//Depto
      //if (idx > -1) console.log("Area 2",ac.long_name);
      idx = ac.types.indexOf('locality');//Ciudad
      if (idx > -1) this.loc.city = ac.long_name;
      idx = ac.types.indexOf('administrative_area_level_2');//Ciudad
      if (idx > -1 && this.loc.city == '') this.loc.city = ac.long_name;
      idx = ac.types.indexOf('neighborhood');//Barrio
      if (idx > -1) this.loc.area = ac.long_name;
      idx = ac.types.indexOf('postal_code');//Codigo Postal
      if (idx > -1) this.loc.zip = ac.long_name;
    }
    console.log("loc", this.loc, acs);
  }
}
