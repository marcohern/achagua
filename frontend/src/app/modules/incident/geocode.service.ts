import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class GeocodeService {

  private static url:string = 'https://maps.googleapis.com/maps/api/geocode/json';
  
  constructor(private http:HttpClient) { }

  private getUrl(lat:number, lng:number):string {
    let s:string = '';
    s = s.concat(GeocodeService.url);
    s = s.concat('?latlng=');
    s = s.concat(lat + ',' + lng);
    s = s.concat('&key=');
    s = s.concat(environment.apikey);
    return s;
  }

  public getReverse(lat:number, lng:number): Observable<any> {
    var url = this.getUrl(lat, lng);
    return this.http.get(url);
  }
}
