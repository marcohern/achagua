import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../../environments/environment';

@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  geocode:string = "https://maps.googleapis.com/maps/api/geocode/json";
  olat: number = 3.441816;
  olng: number = -76.516484;
  lat: number;
  lng: number;
  constructor(private http:HttpClient) { }

  ngOnInit() {
    this.lat = this.olat;
    this.lng = this.olng;
  }

  onClickMap($event) {
    //console.log("map",$event);
    this.lat = $event.coords.lat;
    this.lng = $event.coords.lng;
    var url = this.geocode + '?latlng=' + this.lat + ',' + this.lng + '&key=' + environment.apikey;
    this.http.get(url).subscribe(this.onGetLocationInfo);
  }

  onGetLocationInfo($info) {
    //console.log("info",$info);
    var acs = $info.results[0].address_components;
    console.log("INFO");
    for (let ac of acs) {
      var idx = -1;
      idx = ac.types.indexOf('country');//Pais
      if (idx > -1) console.log("Country",ac.long_name);
      idx = ac.types.indexOf('administrative_area_level_1');//Depto
      if (idx > -1) console.log("Depto",ac.long_name);
      idx = ac.types.indexOf('administrative_area_level_2');//Depto
      if (idx > -1) console.log("City",ac.long_name);
      idx = ac.types.indexOf('locality');//Ciodad
      if (idx > -1) console.log("Area",ac.long_name);
      
    }
  }

}
