import { Component, OnInit } from '@angular/core';
import {VacationsService} from '../vacations.service';
import {Vacation} from '../types';

@Component({
  selector: 'app-my-vacations-page',
  templateUrl: './my-vacations-page.component.html',
  styleUrls: ['./my-vacations-page.component.css']
})
export class MyVacationsPageComponent implements OnInit {
  vacations: Vacation[] = [];

  constructor(
    private vacationsService: VacationsService,
  ) { }

  ngOnInit(): void {
    this.vacationsService.getVacations()
      .subscribe(vacations => this.vacations = vacations);
  }

  onDeleteClicked(vacationId: string): void {
    this.vacationsService.deleteVacation(vacationId)
      .subscribe(() => {
        this.vacations = this.vacations.filter(
          vacation => vacation.id !== vacationId
        );
      });
  }
}
