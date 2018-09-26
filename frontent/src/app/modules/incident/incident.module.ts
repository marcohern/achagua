import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddFormComponent } from './add-form/add-form.component';
import { MapComponent } from './map/map.component';

import { AgmCoreModule } from '@agm/core';

@NgModule({
  imports: [
    CommonModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyBV-6ds73oQP_OTbVylTpvhz3rY6RHpOF8'
    })
  ],
  declarations: [AddFormComponent, MapComponent],
  exports:[ AddFormComponent, MapComponent ]
})
export class IncidentModule { }
