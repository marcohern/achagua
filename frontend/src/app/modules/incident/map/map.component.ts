import { Component, OnInit } from '@angular/core';
import { State } from '../state';
import { City } from '../city';
import { StateService } from '../state.service';
import { AgmMarker } from '@agm/core';

@Component({
  selector: 'incident-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  
  clat: number = 4.701027;
  clng: number = -73.783902;
  lat:number;
  lng:number;
  defRadius: number = 1000;
  defOpacity:number = 0.3;
  amount:number = 12;
  zoom:number = 5.8;

  coZoom = 5.8;
  dpZoom = 8;
  ctZoom = 10;

  selectStates:State[] = [];
  selectCities:City[] = [];

  selectedState:State;
  selectedCity:City;

  stateMarkers:any[] = [];
  cityMarkers:any[] = [];
  
  constructor(private ss:StateService) { }

  private onDeptoChanged() {
    console.log(this.selectedState);
    if (this.selectedState == null) {
      this.cityMarkers = [];
      this.zoom = this.coZoom;
      this.lat = this.clat;
      this.lng = this.clng;
      return;
    }
    this.zoom = this.dpZoom;
    this.lat = this.selectedState.lat;
    this.lng = this.selectedState.lng;

    this.selectCities = this.selectedState.cities;
    this.cityMarkers = [];
    for(let city of this.selectCities) {
      this.cityMarkers.push({lat:city.lat, lng:city.lng});
    }
  }

  private onCityChanged() {
    console.log(this.selectedCity);
  }

  ngOnInit() {

    this.lat = this.clat;
    this.lng = this.clng;
    this.selectStates = this.ss.getStates();
    this.selectCities = [];

    for(let state of this.selectStates) {
      this.stateMarkers.push({lat:state.lat, lng:state.lng});
    }
  }

}
