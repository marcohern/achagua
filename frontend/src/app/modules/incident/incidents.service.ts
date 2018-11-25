import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../../environments/environment';
import { Observable } from 'rxjs';
import { Incident } from './incident';

@Injectable({
  providedIn: 'root'
})
export class IncidentsService {

  private controller:string = 'incidents';

  private url() {
    return environment.apiroot + '/' + this.controller;
  }
  constructor(private http:HttpClient) { }

  public browse(limit:number, offset:number):Observable<any> {
    return this.http.get(this.url());
  }

  public get(id:number):Observable<any> {
    return this.http.get(this.url() + '/' + id);
  }

  public create(incident:Incident):Observable<any> {
    return this.http.post(this.url(), incident);
  }

  public stateCount():Observable<any> {
    return this.http.get(this.url() + '/state_count');
  }

  public stateCountByYear(year:number):Observable<any> {
    return this.http.get(this.url() + '/state_count_by_year/' + year);
  }

  public cityCountByState(stateId:number) : Observable<any> {
    return this.http.get(this.url() + '/city_count_by_state/' + stateId);
  }

  public yearCountByState(stateId:number) : Observable<any> {
    return this.http.get(this.url() + '/year_count_by_state/' + stateId);
  }
}
