import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddFormComponent } from './add-form/add-form.component';
import { MapComponent } from './map/map.component';

import {HttpClientModule} from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AgmCoreModule } from '@agm/core';
import { GeocodeService } from './geocode.service';
import { BsDatepickerModule } from 'ngx-bootstrap/datepicker';
import { ModalModule, BsModalService } from 'ngx-bootstrap/modal';
import { ChartsModule } from 'ng2-charts';

import { environment } from '../../../environments/environment';
import { AddFormSimpleInfoComponent } from './add-form-simple-info/add-form-simple-info.component'
import { ModalComponent } from './modal/modal.component';

import { IncidentsService } from './incidents.service';
import { StateService } from './state.service';


@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    ModalModule,
    ChartsModule,
    BsDatepickerModule.forRoot(),
    AgmCoreModule.forRoot({
      apiKey: environment.apikey
    })
  ],
  declarations: [AddFormComponent, MapComponent, AddFormSimpleInfoComponent, ModalComponent],
  exports:[ AddFormComponent, MapComponent ],
  providers:[ GeocodeService, IncidentsService, BsModalService, StateService ],
  entryComponents: [ModalComponent]
})
export class IncidentModule { }
