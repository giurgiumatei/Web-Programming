import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VacationDataFormComponent } from './vacation-data-form.component';

describe('VacationDataFormComponent', () => {
  let component: VacationDataFormComponent;
  let fixture: ComponentFixture<VacationDataFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VacationDataFormComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(VacationDataFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
