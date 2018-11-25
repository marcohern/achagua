import { Injectable } from '@angular/core';
import { State } from './state';
import { states } from './states';
import { City } from './city';
import { cities } from './cities';

@Injectable({
  providedIn: 'root'
})
export class StateService {

  states:State[] = [];
  cities:City[] = [];

  constructor() {
    this.states = states;
    this.cities = cities;

    for (let city of this.cities) {
      if (city.state == null) {
        var state = this.getState(city.state_id);
        city.state = state;
        if (state.cities==null) state.cities = [];
        state.cities.push(city);
      }
    }
  }

  getStates() {
    return this.states;
  }

  getState(stateId:number) {
    for(let state of states) {
      if (state.id == stateId) {
        return state;
      }
    }
    return null;
  }

  getStateIncidentCount(stateCount:any[], stateId:number) {
    for (let record of stateCount) {
      if (record.sid == stateId) {
        return record;
      }
    }
    return null;
  }

  getCityFromState(state:State, cityId:number) {
    for (let city of state.cities) {
      if (city.id == cityId) {
        return city;
      }
    }
    return null;
  }
}
