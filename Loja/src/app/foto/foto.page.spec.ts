import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { FotoPage } from './foto.page';

describe('FotoPage', () => {
  let component: FotoPage;
  let fixture: ComponentFixture<FotoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FotoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(FotoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
