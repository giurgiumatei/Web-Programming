import {Component, OnInit} from '@angular/core';
import {Vacation} from '../types';
import {VacationsService} from '../vacations.service';

@Component({
  selector: 'app-vacations-page',
  templateUrl: './vacations-page.component.html',
  styleUrls: ['./vacations-page.component.css']
})
export class VacationsPageComponent implements OnInit {
  vacations: Vacation[] = [];
  country: any;
  pageNumber: number | any = 1;

  constructor(private vacationsService: VacationsService,
  ) {
  }

  ngOnInit(): void {
    this.vacationsService.getVacations().subscribe(vacations => this.vacations = vacations);
  }

  Search(): any {
    if (this.country === '') {
      this.ngOnInit();
    } else {
      this.vacations = this.vacations.filter(res => {
        return res.country.toLocaleLowerCase().match(this.country.toLocaleLowerCase());
      });
    }
  }

}
