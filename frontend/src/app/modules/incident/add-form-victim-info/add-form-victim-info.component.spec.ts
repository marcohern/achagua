import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddFormVictimInfoComponent } from './add-form-victim-info.component';

describe('AddFormVictimInfoComponent', () => {
  let component: AddFormVictimInfoComponent;
  let fixture: ComponentFixture<AddFormVictimInfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddFormVictimInfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddFormVictimInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
