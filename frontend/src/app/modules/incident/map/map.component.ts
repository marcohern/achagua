import { Component, OnInit } from '@angular/core';
import { State } from '../state';
import { City } from '../city';
import { StateService } from '../state.service';
import { AgmMarker, MarkerManager, GoogleMapsAPIWrapper } from '@agm/core';

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
  selectYears:number[] = [];

  selectedState:State;
  selectedCity:City;

  stateMarkers:any[] = [];
  cityMarkers:any[] = [];

  
  constructor(private ss:StateService) { }

  private focusStateMarker(state:State) {
    this.zoom = this.dpZoom;
    this.lat = this.selectedState.lat;
    this.lng = this.selectedState.lng;
    this.selectCities = this.selectedState.cities;
    this.cityMarkers = [];
    for(let city of this.selectCities) {
      this.cityMarkers.push({lat:city.lat, lng:city.lng, city});
    }
  }

  private focusCityMarker(city:City) {
    console.log(city);
  }

  private focusReset() {
    this.zoom = this.coZoom;
    this.lat = this.clat;
    this.lng = this.clng;
  }

  private onDeptoChanged() {
    console.log(this.selectedState);
    if (this.selectedState == null) {
      this.cityMarkers = [];
      this.selectCities = [];
      this.focusReset();
    } else {
      this.focusStateMarker(this.selectedState);
    }
  }

  private onCityChanged() {
    this.focusCityMarker(this.selectedCity);
  }

  private onClickStateMarker($event:AgmMarker, marker) {
    var stateId = parseInt(marker.getAttribute('state'));
    this.selectedState = this.ss.getState(stateId);
    this.focusStateMarker(this.selectedState);
  }

  private onClickCityMarker($event:AgmMarker, marker) {
    var cityId = parseInt(marker.getAttribute('city'));
    this.selectedCity = this.ss.getCityFromState(this.selectedState, cityId);
    this.focusCityMarker(this.selectedCity);
  }

  ngOnInit() {

    this.lat = this.clat;
    this.lng = this.clng;
    this.selectStates = this.ss.getStates();
    this.selectCities = [];

    for(let state of this.selectStates) {
      this.stateMarkers.push({lat:state.lat, lng:state.lng, state});
    }

    var now = new Date;
    var begin = now.getFullYear();
    var end = begin - 25;
    for (var i=begin;i>=end;i--) {
      this.selectYears.push(i);
    }
  }
}
