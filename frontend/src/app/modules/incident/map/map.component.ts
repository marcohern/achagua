import { Component, OnInit } from '@angular/core';
import { State } from '../state';
import { City } from '../city';
import { StateService } from '../state.service';
import { AgmMarker, MarkerManager, GoogleMapsAPIWrapper } from '@agm/core';
import { IncidentsService } from '../incidents.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'incident-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  approot:string = '';
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
  selectedYear:number = null;

  stateMarkers:any[] = [];
  cityMarkers:any[] = [];

  totalCount = 0;
  stateCount = [];

  displayGeneral:boolean = true;
  displayState:boolean = false;
  displayCity:boolean = false;
  selectedStateIncidents:any = null;
  selectedStateCities:any[] = [];
  selectedStateYears:any[] = [];
  selectedCityYears:any[] = [];
  mode:string = '';

  
  constructor(private ss:StateService, private is:IncidentsService) { }

  public focusStateMarker(state:State) {
    this.zoom = this.dpZoom;
    this.lat = this.selectedState.lat;
    this.lng = this.selectedState.lng;
    this.selectCities = this.selectedState.cities;
    this.cityMarkers = [];
    for(let city of this.selectCities) {
      this.cityMarkers.push({lat:city.lat, lng:city.lng, city});
    }

    this.getStateDetailsCount(state);
  }

  public focusCityMarker(city:City) {
    console.log(city);
    this.getCityDetailsCount(city);
  }

  public focusReset() {
    this.zoom = this.coZoom;
    this.lat = this.clat;
    this.lng = this.clng;

    this.displayGeneral = true;
    this.displayState = false;
    this.displayCity = false;
  }

  public onDeptoChanged() {
    console.log(this.selectedState);
    if (this.selectedState == null) {
      this.mode = '';
      this.cityMarkers = [];
      this.selectCities = [];
      this.focusReset();
    } else {
      this.mode = 'state';
      this.focusStateMarker(this.selectedState);
    }
  }

  public onCityChanged() {
    if (this.selectedCity == null) {
      this.mode = 'state';
      this.displayCity = false;
    } else {
      this.mode = 'city';
      this.focusCityMarker(this.selectedCity);
    }
  }

  public onYearChanged() {
    console.log(this.selectedYear);
    if (this.mode=='state') this.focusStateMarker(this.selectedState);
    else if (this.mode=='city') this.focusCityMarker(this.selectedCity);
    else this.getStateCount();
  }

  public onClickStateMarker($event:AgmMarker, marker) {
    var stateId = parseInt(marker.getAttribute('state'));
    this.selectedState = this.ss.getState(stateId);
    this.focusStateMarker(this.selectedState);
  }

  public onClickCityMarker($event:AgmMarker, marker) {
    var cityId = parseInt(marker.getAttribute('city'));
    this.selectedCity = this.ss.getCityFromState(this.selectedState, cityId);
    this.focusCityMarker(this.selectedCity);
  }

  public sumVTypes(record) {
    var sum 
      = parseInt(record.v_ps) + parseInt(record.v_sx)
      + parseInt(record.v_pe) + parseInt(record.v_si)
      + parseInt(record.v_ah) + parseInt(record.v_do)
      + parseInt(record.v_lb) + parseInt(record.v_ob)
      + parseInt(record.v_me) + parseInt(record.v_in);
    return sum;
  }

  public appendMult(record) {
    var incidents = parseInt(record.incidents);
    record.mult = "NO";
    if (this.sumVTypes(record) > incidents) record.mult = "SI";
  }

  public getStateCount() {
    this.stateCount = [];
    this.is.stateCount(this.selectedYear).subscribe(result => {
      var total = 0;
      for (let record of result) {
        total += parseInt(record.incidents);
      }
      this.stateCount = result;
      this.totalCount = total;
    });
  }

  public getStateDetailsCount(state:State) {
    this.displayGeneral = false;
    this.displayState = true;
    this.displayCity = false;
    this.selectedStateIncidents = this.ss.getStateIncidentCount(this.stateCount, state.id);
    console.log(this.selectedStateIncidents);
    this.selectedStateCities = [];
    this.is.cityCountByState(state.id, this.selectedYear).subscribe(result => {
      this.selectedStateCities = result;
    });

    this.selectedStateYears = [];
    this.is.yearCountByState(state.id, this.selectedYear).subscribe(result => {
      this.selectedStateYears = result;
    });
  }

  public getCityDetailsCount(city:City) {
    this.displayCity = false;
    this.selectedCityYears = [];
    this.is.yearCountByCity(city.id, this.selectedYear).subscribe(result => {
      this.selectedCityYears = result;
      this.displayCity = true;
    });
  }

  public assets(uri:string) {
    return environment.apiroot + '/assets' + uri;
  }

  ngOnInit() {
    this.approot = environment.maproot;
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

    this.getStateCount();
  }
}
