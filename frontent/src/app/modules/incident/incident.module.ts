import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddFormComponent } from './add-form/add-form.component';
import { MapComponent } from './map/map.component';

import {HttpClientModule} from '@angular/common/http';
import { AgmCoreModule } from '@agm/core';
import { GeocodeService } from './geocode.service';

import { environment } from '../../../environments/environment'

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    AgmCoreModule.forRoot({
      apiKey: environment.apikey
    })
  ],
  declarations: [AddFormComponent, MapComponent],
  exports:[ AddFormComponent, MapComponent ],
  providers:[ GeocodeService ]
})
export class IncidentModule { }
