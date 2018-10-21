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
import { AddFormSimpleInfoComponent } from './add-form-simple-info/add-form-simple-info.component'
import { IncidentsService } from './incidents.service';

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
  declarations: [AddFormComponent, MapComponent, AddFormSimpleInfoComponent],
  exports:[ AddFormComponent, MapComponent ],
  providers:[ GeocodeService, IncidentsService ]
})
export class IncidentModule { }
