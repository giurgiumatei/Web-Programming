import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NewVacationPageComponent } from './new-vacation-page.component';

describe('NewVacationPageComponent', () => {
  let component: NewVacationPageComponent;
  let fixture: ComponentFixture<NewVacationPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ NewVacationPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(NewVacationPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
