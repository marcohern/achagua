import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddFormComponent } from './add-form/add-form.component';
import { MapComponent } from './map/map.component';

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [AddFormComponent, MapComponent]
})
export class IncidentModule { }
