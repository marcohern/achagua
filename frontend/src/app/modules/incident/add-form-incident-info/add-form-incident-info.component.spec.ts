import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddFormIncidentInfoComponent } from './add-form-incident-info.component';

describe('AddFormIncidentInfoComponent', () => {
  let component: AddFormIncidentInfoComponent;
  let fixture: ComponentFixture<AddFormIncidentInfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddFormIncidentInfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddFormIncidentInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
