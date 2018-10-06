import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddFormComponent } from './add-form/add-form.component';
import { MapComponent } from './map/map.component';

import {HttpClientModule} from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AgmCoreModule } from '@agm/core';
import { GeocodeService } from './geocode.service';
import { BsDatepickerModule } from 'ngx-bootstrap/datepicker';

import { environment } from '../../../environments/environment';
import { AddFormVictimInfoComponent } from './add-form-victim-info/add-form-victim-info.component';
import { AddFormIncidentInfoComponent } from './add-form-incident-info/add-form-incident-info.component';
import { AddFormPerpsInfoComponent } from './add-form-perps-info/add-form-perps-info.component'

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    BsDatepickerModule.forRoot(),
    AgmCoreModule.forRoot({
      apiKey: environment.apikey
    })
  ],
  declarations: [AddFormComponent, MapComponent, AddFormVictimInfoComponent, AddFormIncidentInfoComponent, AddFormPerpsInfoComponent],
  exports:[ AddFormComponent, MapComponent ],
  providers:[ GeocodeService ]
})
export class IncidentModule { }
