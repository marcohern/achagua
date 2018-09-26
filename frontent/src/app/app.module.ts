import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { IncidentModule } from './modules/incident/incident.module';
import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    IncidentModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
