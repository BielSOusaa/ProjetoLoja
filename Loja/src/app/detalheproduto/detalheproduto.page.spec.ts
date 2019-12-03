import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { DetalheprodutoPage } from './detalheproduto.page';

describe('DetalheprodutoPage', () => {
  let component: DetalheprodutoPage;
  let fixture: ComponentFixture<DetalheprodutoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetalheprodutoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(DetalheprodutoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
