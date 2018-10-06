import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddFormPerpsInfoComponent } from './add-form-perps-info.component';

describe('AddFormPerpsInfoComponent', () => {
  let component: AddFormPerpsInfoComponent;
  let fixture: ComponentFixture<AddFormPerpsInfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddFormPerpsInfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddFormPerpsInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
