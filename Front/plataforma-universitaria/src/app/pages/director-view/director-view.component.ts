import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-director-view',
  templateUrl: './director-view.component.html',
  styleUrls: ['./director-view.component.scss']
})
export class DirectorViewComponent implements OnInit {
  graficos: any[] = [];
  estadisticas = [];
  constructor(private requestService: RequestService) {
    // this is empty intentionally
  }

  async ngOnInit() {

    this.estadisticas = await this.requestService.getStats() as any;
    this.estadisticas.forEach((periodo: any) => {
      const grafico = [
        {Value: periodo['cantidad-estudiantes-pasaron'], Color:'#498B94', Size:'', Legend:'Pasaron'},
        {Value: periodo['cantidad-estudiantes-perdieron'], Color:'#F8C622', Size:'', Legend:'Perdieron'}
      ];
      const item = {
        periodo: periodo.periodo,
        grafico: grafico
      }
      this.graficos.push(item);
    })
  }

}
